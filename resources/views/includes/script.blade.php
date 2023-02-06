 <!-- General JS Scripts -->
 <script src="{{ asset('assets/modules/popper.js') }}"></script>
 <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
 <script src="{{ asset('assets/js/stisla.js') }}"></script>
 <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
 <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

 <!-- JS Libraies -->

 <!-- Page Specific JS File -->

 <!-- Template JS File -->
 <script src="{{ asset('assets/js/scripts.js') }}"></script>
 <script src="{{ asset('assets/js/custom.js') }}"></script>
 <script>
    
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