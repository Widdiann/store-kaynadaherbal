@extends('layouts.app', ['titlePage' => 'Kaynada herbal - Kontak'])
@push('after-style')
<style>
    .whole-page-overlay{
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        position: fixed;
        background: rgba(0,0,0,0.6);
        width: 100%;
        height: 100% !important;
        z-index: 1050;
        display: none;
        }
        .whole-page-overlay .center-loader{
        top: 50%;
        left: 52%;
        position: absolute;
        color: white;
        }
 </style>
@endpush
@section('content-page')
<div class="whole-page-overlay">

    <div class="tenor-gif-embed center-loader" data-postid="25192894" data-share-method="host" data-aspect-ratio="1" data-width="5%">
        <a href="#" class="btn btn-success">Loading...</a>
        <img src="{{ asset('assets/img/loading.gif') }}" alt="">
    </div> 
</div>

<div class="page-content page-home">

    <section class="information">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="col text-center" style="bold">
                    <h2>Kontak Kami</h2>
                </div>
                <br><br>
                <div class="contact-from-section mt-150 mb-150">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mb-5 mb-lg-0">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            
                                        @endif
                                        <form action="{{ route('send-email') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" id="name" required placeholder="Masukkan Name">
                                              </div>
                                            <div class="mb-3">
                                              <label  class="form-label">Email Address</label>
                                              <input type="email" name="email" class="form-control" id="email" required placeholder="Masukkan Email">
                                            </div>
                                            <div class="mb-3">
                                              <label for="exampleInputPassword1" class="form-label">Message</label>
                                                <textarea name="message" id="message" required class="form-control" cols="30" id="address" rows="5" placeholder="Masukkan Message"></textarea>
                                            </div>
                                            <div class="mb-3 form-check">
                                              <input type="checkbox" name="copy" class="form-check-input" id="exampleCheck1">
                                              <label class="form-check-label" for="exampleCheck1">Send me a copy of this message</label>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary" id="btn-submit" type="submit">Send</button>
                                              </div>
                                          </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="contact-form-wrap">
                                    <div class="contact-form-box">
                                        <h4>Alamat</h4>
                                        <p>Jl. Cileungsi - setu, Kp. Rawahingkik, RT. 001 / RW. 001, No. 34, Desa limusnunggal, Cileungsi, 16820, Bogor, Jawa barat</p>
                                    </div>
                                    <div class="contact-form-box">
                                        <h4>Jam Operasional</h4>
                                        <p>Senin - Sabtu : 07.00 - 19.00 </p>
                                    </div>
                                    <div class="contact-form-box">
                                        <h4>Kontak</h4>
                                        <table>
                                            <tr>
                                                <td>Whatsapp </td>
                                                <td>:</td>
                                                <td><a href="https://wa.me/6281911587270" class="btn text-black"> 0819-1158-7270</a></td>
                                            </tr>
                                            <tr>
                                                <td>Email    </td>
                                                <td>:</td>
                                                <td>
                                                    <a href="mailto:kaynadaherbal@gmail.com"class="btn text-black">kaynadaherbal@gmail.com</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="contact-form-box">
                                        <br><h4>Tentang Website</h4>
                                        <p>Kaynada Herbal Store menjual berbagai jenis produk kesehatan seperti obat herbal, minuman tradisional, minyak angin aromaterapi, vitamin dan suplemen dari Sido Muncul.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <br><br><br>

  
</div>

@endsection
@push('after-script')
    <script>
        $(document).ready(function(){
            // jika name not empty
            $("#btn-submit").on("click", function(){
                if($('#name').val() != '' && $('#email').val() != '' && $('#address').val() != ''){
                    // jika checkbox checked
                    $('.whole-page-overlay').show();
                    
                }
                
            });
               
                
            
        });
    </script>
@endpush