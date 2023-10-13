<script src="{{ asset('vendor/global/global.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>

<!-- Chart piety plugin files -->
<script src="{{ asset('vendor/peity/jquery.peity.min.js')}}"></script>

<!-- Apex Chart -->
<!-- <script src="{{ asset('vendor/apexchart/apexchart.js')}}"></script>-->

<!-- Dashboard 1 -->
<!--<script src="{{ asset('js/dashboard/dashboard-2.js')}}"></script> -->

<script src="{{ asset('js/custom.min.js')}}"></script>
<script src="{{ asset('js/deznav-init.js')}}"></script>
<script src="{{ asset('vendor/toastr/js/toastr.min.js')}}"></script>
<script src="{{ asset('js/sweetalert2.min.js')}}"></script>
<script src="{{ asset('js/tom-select.complete.min.js')}}"></script>
<script src="{{ asset('js/notify.min.js')}}"></script>
<script src="{{ asset('js/slick-loader.min.js')}}"></script>


<script>
    //cuando se cargar completamente la pagina
    window.addEventListener('load', () => {

        document.addEventListener('ok', (event) => {
            Swal.fire({
                title: "<span style='color:orange'>" + "info" + "</span>",
                html: event.detail.msg,
                timer: 3000,
                showConfirmButton: !1,
            }).then((result) => {
                // do something
            })
        })

        // evento para notificar error
        document.addEventListener('noty-error', (event) => {
            SlickLoader.enable()
            toastr.error(event.detail.msg, "Info", {
                positionClass: "toast-bottom-center",
                closeButton: !0,
                progressBar: !0,
            })
        })
        document.addEventListener('stop-loader', (event) => {
            hideProcessing();
        })

        document.addEventListener('noty', (event) => {
            SlickLoader.enable()
            toastr.info(event.detail.msg, "Info", {
                positionClass: "toast-bottom-center",
                closeButton: !0,
                progressBar: !0,
            })
        })

    })


    document.querySelector('.save').addEventListener('click', function() {
        showProcessing()
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('save')) {
            showProcessing()
        }
    })


    //funciones para  ver gif de procesando informacion, cuando se ejecuta un evento

    function showProcessing() {
        SlickLoader.setText('ESPERA', 'PROCESANDO SOLICITUD')
        SlickLoader.enable()

    }


    function hideProcessing() {
        SlickLoader.disable()
    }

    //metodo para confirmacion de eliminar  registros

    function Confirm(componentName, rowId) {
        Swal.fire({
            title: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                showProcessing()
                window.livewire.emitTo(componentName, 'destroy', rowId)

            }
        })
    }
</script>