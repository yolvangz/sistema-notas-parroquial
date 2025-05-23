@php
    $collection = [
        'V' => 'V',
        'E' => 'E',
        'J' => 'J',
        'G' => 'G'
    ];
    $selected = $attributes->get('selected') ?? "";
@endphp
<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <x-adminlte-select name="letraRif" class="border rounded px-2" required>
        @foreach ($collection as $letra)
        <option value="{{$letra}}" @selected($selected === $letra)>{{$letra}}</option>
        @endforeach
    </x-adminlte-select>
</div>