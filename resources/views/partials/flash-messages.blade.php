@if ($message = Session::get('success'))
<script>
    $.toast({
        heading: 'Sucesso',
        text: "{{ $message }}",
        showHideTransition: 'plain',
        icon: 'success',
        position: 'bottom-center'
    })
</script>
@endif

@if ($message = Session::get('error'))
<script>
    $.toast({
        heading: 'Erro',
        text: "{{ $message }}",
        showHideTransition: 'plain',
        icon: 'error',
        position: 'bottom-center'
    })
</script>
@endif

@if ($message = Session::get('warning'))
<script>
    $.toast({
        heading: 'Atenção!',
        text: "{{ $message }}",
        showHideTransition: 'plain',
        icon: 'warning',
        position: 'bottom-center'
    })
</script>
@endif

@if ($message = Session::get('info'))
<script>
    $.toast({
        heading: 'Informação:',
        text: "{{ $message }}",
        showHideTransition: 'plain',
        icon: 'info',
        position: 'bottom-center'
    })
</script>
@endif

@if ($errors->any())
<script>
    $.toast({
        heading: 'Erro Interno',
        text: "Verifique os erros ou entre em contato com o suporte.",
        showHideTransition: 'plain',
        icon: 'error',
        position: 'bottom-center'
    })
</script>
@endif