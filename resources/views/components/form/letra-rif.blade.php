@php
    use App\Models\LetraCedula;
    
    $collection = LetraCedula::whereNot('letra', 'T')->get();
    $selected = $attributes->get('selected') ?? (object)['id' =>null];
@endphp
<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <x-adminlte-select name="letraRif" class="border rounded px-2" required>
        @foreach ($collection as $tipo)
        <option value="{{$tipo->letra}}" @selected($selected->id === $tipo->id)>{{$tipo->letra}}</option>
        @endforeach
    </x-adminlte-select>
</div>