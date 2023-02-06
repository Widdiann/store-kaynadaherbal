<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/script/navbar-scroll.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
 <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    AOS.init({
    once: true
});
</script>
<script>
    //active select2 
    $(document).ready(function () {
        $('#select').select2({
            theme: 'bootstrap4',
            width: 'style',
        });
    });
    //flash message
    @if(session()->has('success'))
    swal({
        type: "success",
        icon: "success",
        title: "BERHASIL!",
        text: "{{ session('success') }}",
        timer: 3500,
        showConfirmButton: false,
        showCancelButton: false,
        buttons: false,
    });
    @elseif(session()->has('error'))
    swal({
        type: "error",
        icon: "error",
        title: "GAGAL!",
        text: "{{ session('error') }}",
        timer: 3500,
        showConfirmButton: false,
        showCancelButton: false,
        buttons: false,
    });
    @endif
</script>