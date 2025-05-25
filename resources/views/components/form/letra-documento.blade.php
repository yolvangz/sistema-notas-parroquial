{{-- Nothing worth having comes easy. - Theodore Roosevelt --}}
@php
    use App\Models\LetraCedula;
    
    $collection = LetraCedula::whereNot('letra', 'T')->get();
    $selected = $attributes->get('selected') ?? (object)['id' =>null];
@endphp
<div>
    <x-adminlte-select2 name="{{ $attributes->get('name') }}" id="{{ $attributes->get('id') }}" class="border rounded px-2" required>
        @foreach ($collection as $tipo)
        <option value="{{$tipo->letra}}" @selected($selected->id === $tipo->id)>{{$tipo->letra}}</option>
        @endforeach
    </x-adminlte-select2>
</div>  