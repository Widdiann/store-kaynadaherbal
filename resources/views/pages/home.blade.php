@extends('layouts.app', ['titlePage' => 'Kaynada Herbal - Home' ])

@section('content-page')
<div class="page-content page-home">
  <section class="store-carousel">
    <div class="container">
      <div class="row">
        <div class="col-lg-12" data-aos="zoom-in">

          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{ asset('assets/img/banner11.jpeg') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/img/banner2.jpeg') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('assets/img/banner3.jpeg') }}" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="store-trend-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Trend Categories</h5>
        </div>
      </div>
      <div class="row">
       @forelse ($categories as $item)
       <div
       class="col-6 col-md-3 col-lg-2"
       data-aos="fade-up"
       data-aos-delay="100"
     >
       <a class="component-categories d-block" href="{{ route('category',$item->slug) }}">
         <div class="categories-image">
           <img
             src="{{ Storage::url($item->photo) }}"
             alt=" "
             class="w-100"
           />
         </div>
         <p class="categories-text">
           {{ $item->name }}
         </p>
       </a>
     </div>
       @empty
       <div
       class="col-6 col-md-3 col-lg-3"
       data-aos="fade-up"
       data-aos-delay="100"
     >
       <a class="component-categories d-block" href="javascript:void(0)">
        
         <p class="categories-text">
          Belum ada kategori
         </p>
       </a>
     </div>
       @endforelse
      
      </div>
    </div>
  </section>
  <section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
         <b> <h5>New Products</h5></b>
        </div>
      </div>
      <div class="row">
             @forelse ($products as $item)
             <div
             class="col-6 col-md-4 col-lg-3"
             data-aos="fade-up"
             data-aos-delay="100"
           ><br>
          
             <div class="card border-0 shadow rounded-md">
               <div class="card-image">
                 <img src="{{ Storage::url($item->galleries->first()->photos) }}" class="w-100" style="height: 15em; object-fit: cover; border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem;">
               </div>
               <div class="card-body">
                 <a href="{{ route('product',$item->slug) }}" class="card-title font-weight-bold" style="font-size: 20px;">{{ $item->name }}</a>
                
                 <div class="price font-weight-bold mt-2" > {{ moneyFormat($item->price) }}</div>
                 <a href="{{ route('product',$item->slug) }}" class="btn btn-primary btn-md mt-3 btn-block shadow-md">LIHAT PRODUK</a>
               </div>
             </div>
            
           </div>
             @empty
             <div
             class="col-6 col-md-3 col-lg-3"
             data-aos="fade-up"
             data-aos-delay="100"
           >
             <a class="component-categories d-block" href="javascript:void(0)">
              
               <p class="categories-text">
                Belum ada produk
               </p>
             </a>
           </div>
             @endforelse
      </div>
    </div>
  </section>
</div>

@endsection