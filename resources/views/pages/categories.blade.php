@extends('layouts.app', ['titlePage' => 'Kaynada Herbal - Categories'])

@section('content-page')
<div class="page-content page-home">
  
  <section class="store-trend-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>All Categories</h5>
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
         <b> <h5>All Products</h5></b>
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
                 <a href="/product/macbook-pro-16-m1-max" class="card-title font-weight-bold" style="font-size: 20px;">{{ $item->name }}</a>
                
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