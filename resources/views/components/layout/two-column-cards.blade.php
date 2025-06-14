{{-- <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca --> --}}
<div class="row">
@if(!$slot->isEmpty())
    <div class="col-md-10 col-xl-8 mx-auto">
        <x-adminlte-card theme="dark" theme-mode="outline" title="{{ $mainCardTitle ?? null }}">
            {{ $slot }}
            @if (isset($mainCardFooter) && !$mainCardFooter->isEmpty())
                <x-slot name="footerSlot">
                    {{ $mainCardFooter }}
                </x-slot>
            @endif
        </x-adminlte-card>
    </div>
@endif
@if(isset($aside) && !$aside->isEmpty())
    <div class="col-md-10 col-xl-4 mx-auto">
        <x-adminlte-card theme="dark" theme-mode="outline" title="{{ $asideCardTitle }}">
            {{ $aside }}
            @if (isset($asideCardFooter) && !$asideCardFooter->isEmpty())
                <x-slot name="footerSlot">
                    {{ $asideCardFooter }}
                </x-slot>
            @endif
        </x-adminlte-card>
    </div>
@endif
</div>