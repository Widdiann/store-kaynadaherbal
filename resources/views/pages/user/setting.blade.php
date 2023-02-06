@extends('layouts.app', ['titlePage' => 'Dashboard Setting User'])

@section('content-page')
<div class="container-fluid" style="padding: 100px 50px">
    <div class="row justify-content-center">
        {{-- <div class="col-md-3">
            @include('pages.includes.sidebar')
        </div> --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>Pengaturan Akun {{ Auth::user()->name }}</h3><br>
                    <form action="{{ route('user.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ old('name',Auth::user()->name) }}" placeholder="Masukkan Name"
                                            class="form-control @error('name') is-invalid @enderror">
            
                                        @error('name')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{ old('email',Auth::user()->email) }}" placeholder="Masukkan Email"
                                            class="form-control @error('email') is-invalid @enderror">
            
                                        @error('email')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                   
                                    <div class="form-group mb-2">
                                        <label>Phone Number</label>
                                        <input type="number" name="phone" value="{{ old('phone',Auth::user()->phone) }}" placeholder="Masukkan Phone Number"
                                            class="form-control @error('phone') is-invalid @enderror">
            
                                        @error('phone')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Password</label>
                                        <input type="password" name="password" 
                                            class="form-control @error('password') is-invalid @enderror">
                                        <span>*Note : kosongkan jika tidak diganti</span>
                                        @error('password')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation"" 
                                            class="form-control ">
            
                                        
                                    </div>
                                   
                               
        
                                </div>
                                
                                
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                                        SIMPAN</button>
                                    <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>


@endsection

