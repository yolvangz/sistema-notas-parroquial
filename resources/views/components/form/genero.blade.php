<!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
@php
    $config = [
        "placeholder" => "Seleccione el género...",
        "allowClear" => true,
    ];
    $selected = $attributes->get('selected')->letra ?? '';
    $attributes = $attributes->except('selected');
@endphp
<div>
    <x-adminlte-select2 id="genero" name="genero" :config="$config" {{ $attributes }}>
        <option value="M" @selected($selected === 'M')>Masculino</option>
        <option value="F" @selected($selected === 'F')>Femenino</option>
    </x-adminlte-select2>
</div>