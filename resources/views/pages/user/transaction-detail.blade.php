@extends('layouts.app', ['titlePage' => 'Dashboard Transaction Detail'])

@section('content-page')
<div class="container-fluid" style="padding: 100px 50px">
    <div class="row">
      {{-- <div class="col-md-3">
        @include('pages.includes.sidebar')
      </div> --}}
      <div class="col-md-12">
       
        <section class="store-cart">
          <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
              <div class="col-12 table-responsive">
                <table
                  class="table table-borderless table-cart"
                  aria-describedby="Cart"
                >
                  <thead>
                    <tr>
                      <th scope="col">Image</th>
                      <th scope="col">Name Product</th>
                      <th scope="col">Price</th>
                      <th scope="col">Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $totalprice = 0 @endphp
                    @forelse ($transaction->transaction_details as $item)
                      <tr>
                      <td >
                      @if ($item->product->galleries->count())
                        <img
                          src="{{url('storage/'.$item->product->galleries->first()->photos)}}"
                          alt=""
                          class="cart-image"
                        />
                      @endif
                      </td>
                      <td >
                        <div class="product-title">{{$item->product->name}}</div>
                      </td>
                      <td >
                        <div class="product-title">{{ moneyFormat($item->price)}}</div>
                        <div class="product-subtitle"></div>
                      </td>
                      <td >
                        <div class="product-title">{{$item->quantity}} Pcs</div>
                        <div class="product-subtitle"></div>
                      </td>
                      <td >
                      
                      </td>
                    </tr> 
                    @empty
                      <tr class="text-center">
                        <td colspan="4">Tidak ada cart</td>
                      </tr>
                    @endforelse
                  
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-12">
                <hr />
              </div>
              <div class="col-12">
                <h2 class="mb-4">Informasi Pengiriman</h2>
              </div>
            </div>
          {{-- <form action="{{ route('checkout') }}" method="POST" id="locations" enctype="multipart/form-data"> --}}
            @csrf
              <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address_one">Nama Lengkap</label>
                    <textarea name="address" id="address" class="form-control" required cols="30" placeholder="Masukkan Alamat Pengiriman" rows="2">{{ $transaction->name }}
                    </textarea>
                  </div>
                </div> 
                      
              <div class="col-md-4" >
                  <div class="form-group" >
                    <label for="phone_number">Nomor HP</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone_number"
                      name="phone_number"
                      value="{{  $transaction->phone }}"
                      required
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address_one">Alamat Lengkap</label>
                    <textarea name="address" id="address" class="form-control address" required cols="30" placeholder="Masukan Alamat pengiriman" rows="1">{!! $transaction->address !!}
                    </textarea>
                  </div>
                </div> 
                
              </div>
              <div class="row">
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="province">Provinsi</label>
                    <select name="provinces_id"  class="form-control">
                    <option>{{ $transaction->province->name }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="fk_regencies_id">Kota / Kabupaten</label>
                  <select name="regencies_id"  class="form-control">
                    <option>{{ $transaction->regency->name }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3" >
                  <div class="form-group">
                    <label for="fk_regencies_id">Kecamatan</label>
                  <select name="district_id"     class="form-control">
                    <option >{{ $transaction->district->name }}</option>
                    </select>
                  
                  </div>
                </div>
                <div class="col-md-3" >
                  <div class="form-group" >
                    <label for="phone_number">Kode Pos</label>
                    <input
                      type="text"
                      class="form-control"
                      id="kode_pos"
                      name="kode_pos"
                      value="{{  $transaction->kode_pos }}"
                      required
                    />
                  </div>
                </div>
              </div>
              
            
            
              <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                  <hr />
                </div>
                <div class="col-12">
                  <h2>Payment Informations</h2>
                </div>
              </div>
              <div class="row" data-aos="fade-up" data-aos-delay="200" >
              
                <div class="col-4 col-md-3">
                  <div class="product-title text-black" >{{ moneyFormat($transaction->total_price) }}</div>
                  <div class="product-subtitle">Total</div>
                </div>
                <div class="col-4 col-md-2">
                  @php
                      if ($transaction->status == 'pending') {
                            $status = '<span class="badge bg-warning">Pending</span>';
                        } elseif ($transaction->status == 'success') {
                            $status = '<span class="badge bg-success">Success</span>';
                        } elseif ($transaction->status == 'failed') {
                            $status = '<span class="badge bg-danger">Failed</span>';
                        }
                  @endphp
                  <div class="product-title " >{!! $status !!}</div>
                </div>
                <div class="col-4 col-md-3">
                  @if ($transaction->status == 'pending')
                      <a href="{{ $transaction->midtrans }}" class="btn mt-2 btn-success btn-block">
                          <i class="fa fa-check"></i>
                          Bayar
                      </a>
                  @endif
                  
                </div>
              </div>
            </div>
            {{-- </form> --}}
        </section>
      </div>
    </div>
</div>


@endsection

@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script>
    var editor_config = {
        selector: "textarea.address",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
    };

    tinymce.init(editor_config);
</script>
@endpush
