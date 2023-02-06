@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Admin</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.admin.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Admin</a>
                </div>

                <div class="card-body">
                  
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-admin" style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAME</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">PHONE NUMBER</th>
                                <th scope="col">CREATED</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                           
                        </table>
                      
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


@endsection

@push('after-script')
<script>
    // Datatables
    var datatable = $('#table-admin').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! url()->current() !!}',
                type: 'GET',
            },
         
            columns: [                   
                { "data": "id", "name": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action'
                },
               
            ],
            columnDefs: [
                {
                    "targets": 0, // your case first column
                    "className": "text-center",
                },
                {
                    "targets": 1, // your case first column
                    "className": "text-center",
                },
                {
                    "targets": 2, // your case first column
                    "className": "text-center",
                },
                {
                    "targets": 3, // your case first column
                    "className": "text-center",
                },
                {
                    "targets": 4, // your case first column
                    "className": "text-center",
                },
                {
                    "targets": 5, // your case first column
                    "className": "text-center",
                },
             
               
               
               
           ]
        });
    //ajax delete
    function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    //ajax delete
                    jQuery.ajax({
                        url: "/dashboard/admin/"+id,
                        data:   {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                } else {
                    return true;
                }
            })
        }
</script>
@endpush