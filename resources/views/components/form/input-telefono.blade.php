{{-- <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca --> --}}
<x-adminlte.form.input data-inputmask="'mask': '+58 999-9999999'" {{ $attributes }} />

@pushOnce('js')
<script>
    if (window.Inputmask) Inputmask({
		placeholder: "_",
		showMaskOnHover: false, // disable mask display on hover
		showMaskOnFocus: false, // disable mask display on focus
		clearMaskOnLostFocus: false // keep mask when input loses focus
	}).mask(document.querySelectorAll("input[data-inputmask]"));
</script>
@endpushOnce