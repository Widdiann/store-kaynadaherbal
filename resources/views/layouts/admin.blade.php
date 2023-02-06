<!DOCTYPE html>
<html lang="en">

<head>
   @stack('before-style')
    @include('includes.style')
    @stack('after-style')

</head>

<body style="background: #e2e8f0">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            
            @include('includes.navbar')
            
            @include('includes.sidebar')

            <!-- Main Content -->
            @yield('content')

            @include('includes.footer')
        </div>
    </div>
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')
</body>
</html>