<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; Kaynada Herbal</title>

    {{-- <link rel="shortcut icon" href="{{ asset('assets/img/school.svg') }}" type="image/x-icon"> --}}

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body style="background: #e2e8f0">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        {{-- <div class="login-brand">
                            <img src="{{ asset('assets/img/school.svg') }}" alt="logo" width="100"
                                class="shadow-light rounded-circle" style="padding:10px;background: white;">
                        </div> --}}

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register User</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}" class="needs-validation"
                                    novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input id="name" v-model="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                      
                                                      @error('name')
                                                          <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                      @enderror
                                                      
                                      </div>
                                      <div class="form-group">
                                        <label>Phone Number</label>
                                        <input  type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukkan Phone Number" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                      
                                                      @error('phone')
                                                          <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                      @enderror
                                                      
                                      </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            placeholder="Masukkan Alamat Email" value="{{ old('email') }}" tabindex="1"
                                            required autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5" placeholder="MasukKan Address">{{ old('address') }}</textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password"
                                                class="control-label ">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Masukkan Password" tabindex="2" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                  


                                 

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Register
                                        </button>
                                        <a href="{{ route('login') }}" class="btn btn-secondary btn-lg btn-block" tabindex="4">
                                            Login
                                        </a>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>