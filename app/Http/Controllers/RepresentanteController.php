<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Representante;
use App\Models\LetraCedula;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RepresentanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $representantes = Representante::with('letraCedula')
            ->when($search, function ($query, $search) {
                $query->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('cedulaNumero', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('apellidos')
            ->paginate(10);

        return view('representante.index', ['representantes' => $representantes]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Representante $representante): View
    {
        $representante->load('letraCedula');
        return view('representante.show', ['representante' => $representante]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $letrasCedula = LetraCedula::all();
        return view('representante.create', compact('letrasCedula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $letraCedulaID = LetraCedula::where('letra', $request->input('cedulaLetra'))->value('IDLetraCedula');

        $request->merge(['cedulaLetraID' => $letraCedulaID]);
        if ($request->get('telefonoSecundario') === '+58 ___-_______') $request->merge(['telefonoSecundario' => null]);
        
        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'cedulaLetraID' => ['required', 'exists:LetrasCedula,IDLetraCedula'],
            'cedulaNumero' => [
                'required',
                'numeric',
                Rule::unique('Representantes')->where(function ($query) use ($letraCedulaID) {
                    return $query->where('cedulaLetra', $letraCedulaID);
                })
            ],
            'genero' => ['required', Rule::in(['M', 'F'])],
            'fechaNacimiento' => ['required', 'date', 'before:today'],
            'direccion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:320', Rule::unique('Representantes', 'email')],
            'telefonoPrincipal' => ['required', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'], // Adjusted regex
            'telefonoSecundario' => ['nullable', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'], // Adjusted regex
        ]);
        $validatedData['cedulaLetra'] = $letraCedulaID;
        $validatedData['cedulaLetraID'] = null;
        
        $representante = new Representante($validatedData);
        $representante->save();
        
        return redirect()->route('representante.index')->with('success', 'Representante creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Representante $representante): View
    {
        $representante->load('letraCedula');
        return view('representante.edit', ['representante' => $representante]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Representante $representante): RedirectResponse
    {
        $letraCedulaInput = $request->input('cedulaLetra');
        $letraCedula = is_numeric($letraCedulaInput) ? LetraCedula::find($letraCedulaInput) : LetraCedula::where('letra', $letraCedulaInput)->first();
        $letraCedulaID = $letraCedula ? $letraCedula->IDLetraCedula : $representante->cedulaLetra;

        $request->merge(['cedulaLetra_validated_id' => $letraCedulaID]);
        if ($request->get('telefonoSecundario') === '+58 ___-_______') $request->merge(['telefonoSecundario' => null]);

        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'cedulaLetra_validated_id' => ['required', 'exists:LetrasCedula,IDLetraCedula'],
            'cedulaNumero' => [
                'required',
                'numeric',
                Rule::unique('Representantes')->where(function ($query) use ($letraCedulaID) {
                    return $query->where('cedulaLetra', $letraCedulaID);
                })->ignore($representante->IDRepresentante, 'IDRepresentante')
            ],
            'genero' => ['required', Rule::in(['M', 'F'])],
            'fechaNacimiento' => ['required', 'date', 'before_or_equal:today'],
            'direccion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:320', Rule::unique('Representantes', 'email')->ignore($representante->IDRepresentante, 'IDRepresentante')],
            'telefonoPrincipal' => ['required', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'], // Adjusted regex
            'telefonoSecundario' => ['nullable', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'], // Adjusted regex
            'estudiantes' => ['nullable', 'array'],
            'estudiantes.*' => ['integer', 'exists:Estudiantes,IDEstudiante'],
            'representantePrincipal' => ['nullable', 'array'],
            'representantePrincipal.*' => ['integer', Rule::in($request->input('estudiantes'))],
            // 'fotoPerfilPath' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            // 'cedulaPath' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,pdf', 'max:2048'],
        ]);

        /* if ($request->hasFile('fotoPerfilPath')) {
            if ($representante->fotoPerfilPath && Storage::disk('public')->exists($representante->fotoPerfilPath)) {
                Storage::disk('public')->delete($representante->fotoPerfilPath);
            }
            $validatedData['fotoPerfilPath'] = $request->file('fotoPerfilPath')->store('representantes/fotos_perfil', 'public');
        }

        if ($request->hasFile('cedulaPath')) {
            if ($representante->cedulaPath && Storage::disk('public')->exists($representante->cedulaPath)) {
                Storage::disk('public')->delete($representante->cedulaPath);
            }
            $validatedData['cedulaPath'] = $request->file('cedulaPath')->store('representantes/cedulas', 'public');
        } */
        
        $validatedData['cedulaLetra'] = $validatedData['cedulaLetra_validated_id'];
        unset($validatedData['cedulaLetra_validated_id']);

        $representante->update($validatedData);
        if (array_key_exists('estudiantes', $validatedData) && !empty($validatedData['estudiantes'])) {
            $validatedData['estudiantes'] = array_merge($validatedData['estudiantes'], 
                    array_map(function($representante) {
                        return ['representantePrincipal' => true];
                    }, $validatedData['representantePrincipal']
                )
            );
            $representante->estudiantes()->sync($validatedData['estudiantes']);
        } else {
            $representante->estudiantes()->detach();
        }

        return redirect()->route('representante.show', $representante)->with('success', 'Representante actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Representante $representante): RedirectResponse
    {
        $representante->delete();
        return redirect()->route('representante.index')->with('success', 'Representante eliminado con éxito.');
    }

    public function buscarEstudiantes(Request $request): JsonResponse
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'checkedEstudiantes' => 'nullable|array',
            'checkedEstudiantes.*' => 'integer',
        ]);

        $search = $request->input('search');
        $checkedEstudiantes = $request->input('checkedEstudiantes', []);

        // Fetch estudiantes matching the search query
        $estudiantesQuery = Estudiante::query();

        if ($search) {
            $estudiantesQuery->where(function ($query) use ($search) {
                $query->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('cedulaNumero', 'like', "%{$search}%");
            });
        }

        // Include already checked estudiantes
        $estudiantesQuery->orWhereIn('IDEstudiante', $checkedEstudiantes);

        $estudiantes = $estudiantesQuery->get()->map(function ($estudiante) use ($checkedEstudiantes) {
            return [
                'id' => $estudiante->id,
                'nombreCompleto' => $estudiante->nombres . ' ' . $estudiante->apellidos,
                'letraCedula' => $estudiante->letraCedula->letra,
                'cedulaNumero' => $estudiante->cedulaNumero,
                'checked' => in_array($estudiante->id, $checkedEstudiantes),
            ];
        });

        // Sort by checked status and nombreCompleto
        $sortedEstudiantes = $estudiantes->sortBy([
            ['checked', 'desc'],
            ['nombreCompleto', 'asc'],
        ])->values();

        return response()->json($sortedEstudiantes);
    }
}
