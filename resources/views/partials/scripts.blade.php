<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
<!-- End custom js for this page -->

<script src="{{ asset('assets/vendors/toasts/js/jquery.toast.min.js') }}"></script>

<script src="{{ asset('assets/vendors/input.mask/js/jquery.maskMoney.js') }}"></script>

<script src="{{ asset('assets/vendors/select2/js/select2.min.js') }}"></script>

<!-- <script src="{{ asset('assets/vendors/bootstrap5.3/js/bootstrap.bundle.min.js') }}"></script> -->


<script>
    $(document).ready(function() {
        $('.money').maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            thousands: '.',
            decimal: ',',
            affixesStay: true
        });

        $('select').select2();

        /** Payment URL Copy */



        $('.payment-url-btn').click(function() {
            //Visto que o 'copy' copia o texto que estiver selecionado, talvez você queira colocar seu valor em um txt escondido
            $('.payment-url').select();
            try {
                var ok = document.execCommand('copy');
                if (ok) {
                    alert('Texto copiado para a área de transferência');
                }
            } catch (e) {
                alert(e)
            }
        });
    })
</script>