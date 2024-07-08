<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/js/datatable-basic.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/main.js') }}"></script>
<script src="{{ asset('assets/libs/toastr/js/toastr-init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@yield('page-scripts')

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            toastr.success("{{ session('success') }}", "¡Éxito!", {
                progressBar: true,
            });
        });
    </script>
    @php
        session()->forget('success');
    @endphp
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            toastr.error("{{ session('error') }}", "Ups!", {
                progressBar: true,
            });
        });
    </script>
    @php
        session()->forget('error');
    @endphp
@endif
