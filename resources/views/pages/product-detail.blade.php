@extends('layouts.app', ['titlePage' => 'Kaynada Herbal - Product ' . $product->name])
@push('after-style')
    <style>
      @media only screen and (max-width: 600px) {
 .thumbnail-image{
      max-width: 150px !important;
      max-height: 150px !important;
 }
}
    </style>
@endpush
@section('content-page')
<div class="page-content page-details" id="gallery">
    <section
      class="store-breadcrumbs"
      data-aos="fade-down"
      data-aos-delay="100"
    >
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  Product Details
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <section class="store-gallery" >
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8"  data-aos="zoom-in">
            <transition name="slide-fade" mode="out-in">
              <img
                :key="photos[activePhoto].id"
                :src="photos[activePhoto].url"
                class=" main-image"
                style="max-width: 250px; max-height: 250px;"
                alt=""
              />
            </transition>
            <div class="row mt-2">
                <div
                class=" col-md-3  col-3"
                v-for="(photo, index) in photos"
                :key="photo.id"
                data-aos="zoom-in"
                data-aos-delay="100"
              >
                <a href="#" @click="changeActive(index)">
                  <img
                    :src="photo.url"
                    class="w-100 thumbnail-image"
                    {{-- style="height: 120px; width: 120px;" --}}
                    :class="{ active: index == activePhoto }"
                    alt=""
                  />
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 ">
            <div class="store-description">
                   
                    <div class="store-details-container" data-aos="fade-up">
                        <section class="store-heading">
                                <h1>{{$product->name}}</h1>
                               <div class="description my-3" style="height: 500px !important">
                                {!! $product->description !!}
                               </div>
                               <br>

                               <div class="harga">
                                <h4>Harga</h4>
                               </div>
                                <div class="price">
                                   
                                    {{ moneyFormat($product->price)}}
                                </div>
                              </div>
                              <div class="stock" data-aos="zoom-in">
                                  @auth
                                  <form action="{{ route('addToCart',$product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    Stok : 
                                    {{ $product->quantity }}
                  
                                    <br>
                                    <br>
                                    <label for="">Quantity</label>
                                    <div class="d-flex my-2">
                                      <button type="button" @click="GetMin()" class="btn btn-sm btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                      <input
                                        type="number"
                                        name="quantity"
                                        class="form-control"
                                        readonly
                                        min="1"
                                        max="{{ $product->quantity }}"
                                        v-model="quantity"
                                        style="width: 70px !important;"
                                      />
                                      <button type="button" @click="GetPlush()" class="btn btn-sm btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  
                                    </div>
                                    <button
                                    type="submit "
                                    class="btn btn-primary  px-4 mt-2 text-white btn-block mb-3 " {{ $product->quantity <= 0 ? 'disabled' : '' }}
                                    {{ $product->quantity == 0 ? 'disabled' : '' }}
                                    >Add to Cart
                                    </button>
                                  </form>
                                  @else
                                    <a
                                    href="{{route('login')}}"
                                    class="btn btn-primary px-4 text-white btn-block mb-3"
                                    >Sign in
                                    </a>
                                  @endauth
                        </section>
                  
                      
                    </div>
              </div>
          </div>
        </div>
      </div>
    </section>
    
  </div>
@endsection
@push('after-script')
    <script src="{{ asset('assets/vendor/vue/vue.js') }}"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          quantity: 1,
          photos: [
           @foreach($product->galleries as $gallery)
            {
              id: {{$gallery->id}},
              url: "{{url('storage/'.$gallery->photos)}}",
            },
          @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
          GetMin(){
            if(this.quantity > 1){
              this.quantity--;
            }
          },

          GetPlush(){
            if(this.quantity < {{ $product->quantity }}){
              this.quantity++;
            }
            // this.quantity += 1;
          }
        },
      });
    </script>
@endpush