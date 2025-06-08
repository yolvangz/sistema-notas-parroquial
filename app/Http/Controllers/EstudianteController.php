<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\LetraCedula;
use App\Models\Representante;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $estudiantes = Estudiante::with('letraCedula')
            ->when($search, function ($query, $search) {
                $query->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('cedulaNumero', 'like', "%{$search}%");
            })
            ->orderBy('apellidos')
            ->paginate(10);

        return view('estudiante.index', ['estudiantes' => $estudiantes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Assuming you have a view named 'estudiante.create'
        // You might want to pass LetrasCedula if you have a dropdown for it
        $letrasCedula = LetraCedula::all();
        return view('estudiante.create', compact('letrasCedula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $letraCedulaInput = $request->input('cedulaLetra');
        $letraCedula = is_numeric($letraCedulaInput) ? LetraCedula::find($letraCedulaInput) : LetraCedula::where('letra', $letraCedulaInput)->first();
        $letraCedulaID = $letraCedula ? $letraCedula->IDLetraCedula : null;

        // Merge the ID back for validation if it was a letter
        if ($letraCedulaID && !is_numeric($letraCedulaInput)) {
            $request->merge(['cedulaLetra' => $letraCedulaID]);
        }

        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'cedulaLetra' => ['required', 'exists:LetrasCedula,IDLetraCedula'],
            'cedulaNumero' => [
                'required',
                'numeric',
                Rule::unique('Estudiantes')->where(function ($query) use ($letraCedulaID) {
                    return $query->where('cedulaLetra', $letraCedulaID);
                })
            ],
            'genero' => ['required', Rule::in(['M', 'F'])],
            'fechaNacimiento' => ['required', 'date', 'before_or_equal:today'],
            'direccion' => ['required', 'string', 'max:255'],
            'fotoPerfilPath' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'cedulaPath' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,pdf', 'max:2048'],
            'partidaNacimientoPath' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,pdf', 'max:2048'],
        ]);
        
        // Handle file uploads
        if ($request->hasFile('fotoPerfilPath')) {
            $validatedData['fotoPerfilPath'] = $request->file('fotoPerfilPath')->store('estudiantes/fotos_perfil', 'public');
        }
        if ($request->hasFile('cedulaPath')) {
            $validatedData['cedulaPath'] = $request->file('cedulaPath')->store('estudiantes/cedulas', 'public');
        }
        if ($request->hasFile('partidaNacimientoPath')) {
            $validatedData['partidaNacimientoPath'] = $request->file('partidaNacimientoPath')->store('estudiantes/partidas_nacimiento', 'public');
        }

        $estudiante = new Estudiante($validatedData);
        // Ensure cedulaLetra is the ID
        $estudiante->cedulaLetra = $letraCedulaID;
        $estudiante->save();

        return redirect()->route('estudiante.index')->with('success', 'Estudiante creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante): View
    {
        // Eager load relationships if needed in the view
        $estudiante->load('letraCedula');
        return view('estudiante.show', ['estudiante' => $estudiante]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante): View
    {
        $estudiante->load('representantes');
        return view('estudiante.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante): RedirectResponse
    {
        $letraCedulaInput = $request->input('cedulaLetra');
        // If the input is the letter (e.g., "V"), find its ID. If it's already an ID, use it directly.
        $letraCedula = is_numeric($letraCedulaInput) ? LetraCedula::find($letraCedulaInput) : LetraCedula::where('letra', $letraCedulaInput)->first();
        $letraCedulaID = $letraCedula ? $letraCedula->IDLetraCedula : $estudiante->cedulaLetra; // Fallback to existing if not found

        // Merge the ID back for validation consistency
        $request->merge(['cedulaLetra_validated_id' => $letraCedulaID]);

        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'cedulaLetra_validated_id' => ['required', 'exists:LetrasCedula,IDLetraCedula'], // Validate the resolved ID
            'cedulaNumero' => [
                'required',
                'numeric',
                Rule::unique('Estudiantes')->where(function ($query) use ($letraCedulaID) {
                    return $query->where('cedulaLetra', $letraCedulaID);
                })->ignore($estudiante->IDEstudiante, 'IDEstudiante')
            ],
            'genero' => ['required', Rule::in(['M', 'F'])],
            'fechaNacimiento' => ['required', 'date', 'before:today'],
            'direccion' => ['required', 'string', 'max:255'],
            'representantes' => ['nullable', 'array'],
            'representantes.*' => ['integer', 'exists:Representantes,IDRepresentante'],
            'representantePrincipal' => ['nullable', 'integer', Rule::in($request->input('representantes'))],
            'fotoPerfilPath' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'cedulaPath' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,pdf', 'max:2048'],
            'partidaNacimientoPath' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,pdf', 'max:2048'],
        ]);

        // Handle file uploads and deletion of old files
        if ($request->hasFile('fotoPerfilPath')) {
            if ($estudiante->fotoPerfilPath && Storage::disk('public')->exists($estudiante->fotoPerfilPath)) {
                Storage::disk('public')->delete($estudiante->fotoPerfilPath);
            }
            $validatedData['fotoPerfilPath'] = $request->file('fotoPerfilPath')->store('estudiantes/fotos_perfil', 'public');
        }

        if ($request->hasFile('cedulaPath')) {
            if ($estudiante->cedulaPath && Storage::disk('public')->exists($estudiante->cedulaPath)) {
                Storage::disk('public')->delete($estudiante->cedulaPath);
            }
            $validatedData['cedulaPath'] = $request->file('cedulaPath')->store('estudiantes/cedulas', 'public');
        }

        if ($request->hasFile('partidaNacimientoPath')) {
            if ($estudiante->partidaNacimientoPath && Storage::disk('public')->exists($estudiante->partidaNacimientoPath)) {
                Storage::disk('public')->delete($estudiante->partidaNacimientoPath);
            }
            $validatedData['partidaNacimientoPath'] = $request->file('partidaNacimientoPath')->store('estudiantes/partidas_nacimiento', 'public');
        }
        
        // Update cedulaLetra with the resolved ID
        $validatedData['cedulaLetra'] = $validatedData['cedulaLetra_validated_id'];
        unset($validatedData['cedulaLetra_validated_id']); // Clean up temporary validation field


        $estudiante->update($validatedData);
        if (array_key_exists('representantes', $validatedData) && !empty($validatedData['representantes'])) {
            $estudiante->representantes()->sync(
                $validatedData['representantes'] + [
                    $validatedData['representantePrincipal'] => ['representantePrincipal' => true]
                ]
            );
        } else {
            $estudiante->representantes()->detach();
        }

        return redirect()->route('estudiante.show', $estudiante)->with('success', 'Estudiante actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante): RedirectResponse
    {
        // Note: Files are not deleted from storage on soft delete by default.
        // If you want to delete files, you'd add that logic here or use model events.
        $estudiante->delete();
        return redirect()->route('estudiante.index')->with('success', 'Estudiante eliminado con éxito.');
    }

    public function buscarRepresentantes(Request $request): JsonResponse
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'checkedRepresentantes' => 'nullable|array',
            'checkedRepresentantes.*' => 'integer',
        ]);

        $search = $request->input('search');
        $checkedRepresentantes = $request->input('checkedRepresentantes', []);

        // Fetch representantes matching the search query
        $representantesQuery = Representante::query();

        if ($search) {
            $representantesQuery->where(function ($query) use ($search) {
                $query->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('cedulaNumero', 'like', "%{$search}%");
            });
        }

        // Include already checked representantes
        $representantesQuery->orWhereIn('IDRepresentante', $checkedRepresentantes);

        $representantes = $representantesQuery->get()->map(function ($representante) use ($checkedRepresentantes) {
            return [
                'id' => $representante->id,
                'nombreCompleto' => $representante->nombres . ' ' . $representante->apellidos,
                'letraCedula' => $representante->letraCedula->letra,
                'cedulaNumero' => $representante->cedulaNumero,
                'checked' => in_array($representante->id, $checkedRepresentantes),
            ];
        });

        // Sort by checked status and nombreCompleto
        $sortedRepresentantes = $representantes->sortBy([
            ['checked', 'desc'],
            ['nombreCompleto', 'asc'],
        ])->values();

        return response()->json($sortedRepresentantes);
    }
}
