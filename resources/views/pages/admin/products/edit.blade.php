@extends('layouts.admin', ['title' => 'Dashboard Admin Product Create'])

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-pencil-alt"></i> Edit Product</h4>
                </div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="form-group">
                                        <label>Nama Product</label>
                                        <input type="text" name="name" value="{{ old('name',$product->name) }}" placeholder="Masukkan Nama Product"
                                            class="form-control @error('name') is-invalid @enderror">
            
                                        @error('name')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label>Categories</label>
                                        <select name="categories_id" class="form-control @error('categories_id') is-invalid @enderror" id="select">
                                            <option value="">Pilih Categories</option>
                                            @foreach ($categories as $category)
                                            <option {{ old('categories_id') == $category->id ? "selected" : "" }} {{ $product->categories_id == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
            
                                        @error('categories_id')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="price" value="{{ old('price',$product->price) }}" placeholder="Masukkan Price"
                                            class="form-control @error('price') is-invalid @enderror">
            
                                        @error('price')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" value="{{ old('quantity',$product->quantity) }}" placeholder="Masukkan Quantity"
                                            class="form-control @error('quantity') is-invalid @enderror">
            
                                        @error('quantity')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
            
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="" placeholder="Masukan Description" class="form-control description @error('description') is-invalid @enderror" cols="30" rows="5">
                                            {{ old('description',$product->description) }}
                                        </textarea>
            
                                        @error('description')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                   
                                    <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                                        SIMPAN</button>
                                    <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                               
        
                            </form>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($product->galleries as $item)
                                    <div class="col-md-4">
                                        <div class="gallery-container">
                                            <img src="{{ asset('storage/'.$item->photos) }}" alt="" class="w-100" height="200">
                                        <a href="{{ route('admin.product.gallery.delete',$item->id) }}" class="delete-gallery" style="display: block;
                                        position: absolute;
                                        top: -10px;
                                        right: 0;" href="#">
                                            <img src="{{ asset('assets/img/icon-delete.svg') }}" alt="" />
                                          </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col mt-3">
                                <form action="{{ route('admin.upload.gallery') }}" enctype="multipart/form-data" method="POST">
                                  @csrf
                                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                                  <input
                                      type="file"
                                      name="photos"
                                      id="file"
                                      style="display: none;"
                                      onchange="form.submit()"
                                    />
                                    <button
                                    type="button"
                                      class="btn btn-secondary btn-block"
                                      style="background-color: #6c757d"
                                      onclick="thisFileUpload();"
                                    >
                                    Add Photo
                                  </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


@endsection
@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script>
    $(document).ready(function () {
         $('select').select2({
             theme: 'bootstrap4',
             width: 'style',
         });
     });
    var editor_config = {
        selector: "textarea.description",
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
<script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
@endpush
