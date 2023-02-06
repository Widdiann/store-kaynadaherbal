@extends('layouts.admin', ['title' => 'Dashboard Admin Product Create'])

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Tambah Product</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Product</label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Product"
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
                                    <option {{ old('categories_id') == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <input type="number" name="price" value="{{ old('price') }}" placeholder="Masukkan Price"
                                    class="form-control @error('price') is-invalid @enderror">
    
                                @error('price')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" value="{{ old('quantity') }}" placeholder="Masukkan Quantity"
                                    class="form-control @error('quantity') is-invalid @enderror">
    
                                @error('quantity')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="" placeholder="Masukkan Description" class="form-control description @error('description') is-invalid @enderror" cols="30" rows="5">
                                    {{ old('description') }}
                                </textarea>
    
                                @error('description')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" 
                                    class="form-control @error('photo') is-invalid @enderror">
    
                                @error('photo')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                                SIMPAN</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                        </div>
                     </div>

                    </form>
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
@endpush
