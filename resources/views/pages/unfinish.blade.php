@extends('layouts.app', ['titlePage' => 'Pembayaran belum berhasil'])

@section('content-page')
 <!-- Page Content -->
 <div class="page-content page-success">
   <div class="section-success" data-aos="zoom-in">
     <div class="container">
       <div class="row align-items-center row-login justify-content-center">
         <div class="col-lg-6 text-center">
           <img src="/images/success.svg" alt="" class="mb-4" />
           <h2>
             Transaksi Belum berhasil !
           </h2>
           <p>
           Silahkan lakukan pembayaran, Terimakasih <br />
           
           </p>
           <div>
             <a class="btn btn-success w-50 mt-4" href="{{ route('transactions.user.index') }}">
               Lihat Transaksi
             </a>
             <a class="btn btn-signup w-50 mt-2" href="{{ route('home') }}">
               Home
             </a>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>

@endsection