{{-- Nothing worth having comes easy. - Theodore Roosevelt --}}
@php
    use App\Models\LetraCedula;
    
    $collection = LetraCedula::whereNot('letra', 'T')->get();
    $selected = $attributes->get('selected') ?? (object)['id' =>null];
    $exclusiones = $attributes->get('except') ?? [];
@endphp
<div>
    <x-adminlte-select2 name="{{ $attributes->get('name') }}" id="{{ $attributes->get('id') }}" class="border rounded px-2" required>
        @foreach ($collection as $tipo)
        @if (array_find($exclusiones, fn($e) => $e === $tipo->letra))
            @continue
        @endif
        <option value="{{$tipo->letra}}" @selected($selected->id === $tipo->id)>{{$tipo->letra}}</option>
        @endforeach
    </x-adminlte-select2>
</div>  