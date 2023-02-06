@extends('layouts.app', ['titlePage' => 'Dashboard User'])

@section('content-page')
<div class="container-fluid" style="padding: 100px 50px">
    <div class="row">
        {{-- <div class="col-md-3">
            @include('pages.includes.sidebar')
        </div> --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4> Transactions {{ Auth::user()->name }}</h4>
                </div>

                <div class="card-body">
                  
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-transactions" style="width: 100%">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                           
                        </table>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection