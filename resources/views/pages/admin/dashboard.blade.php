@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-body">
                      <h3>Selamat Datang {{ auth()->user()->name }}</h3>
                  </div>
              </div>
          </div>
         </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fa fa-dollar-sign text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>PENDAPATAN HARI INI</h4>
                  </div>
                  <div class="card-body">
                    {{ moneyFormat($days) }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fa fa-dollar-sign text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>PENDAPATAN BULAN INI </h4>
                  </div>
                  <div class="card-body">
                    {{ moneyFormat($month) }}

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fa fa-dollar-sign text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>PENDAPATAN TAHUN INI</h4>
                  </div>
                  <div class="card-body">
                    {{ moneyFormat($year) }}

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fa fa-users text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>USERS</h4>
                  </div>
                  <div class="card-body">
                    {{ $user }}
                  </div>
                </div>
              </div>
            </div>                  
        </div>
      

    </section>
</div>
@endsection