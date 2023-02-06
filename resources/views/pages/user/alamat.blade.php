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
                    <h3>Pengaturan Alamat {{ Auth::user()->name }}</h3><br>
                    <form action="{{ route('user.setting.alamat') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                                <div class="col-md-12" >
                                    <div class="form-group mb-2">
                                       <label>Alamat Lengkap</label>
                                       <textarea name="address" id="address" class="form-control address" placeholder="Masukan address" cols="30" rows="5">{{ old('address',Auth::user()->address) }}
                                       </textarea>

                                       @error('address')
                                       <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                       </div>
                                       @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                       <label>Provinsi</label>
                                       <select name="province_id" id="select" class="form-control @error('province_id') is-invalid @enderror">
                                             <option value="">Pilih Provinsi</option>
                                             @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" {{ old('province_id',Auth::user()->province_id) == $province->id ? 'selected' : '' }}>
                                                   {{ $province->name }}
                                                </option>
                                             @endforeach
                                       </select>
                                       @error('province_id')
                                       <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                       </div>
                                       @enderror
                                    </div>
                                    
                                    <div class="form-group mb-2">
                                       <label>Kota</label>
                                       <select name="regencies_id" class="form-control" id="regencies_id" required>
                                             <option value="">Pilih Kota</option>
                                       </select>

                                       @error('regencies_id')
                                       <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                       </div>
                                       @enderror
                                    </div>
                                 </div>
                                 
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                                        SIMPAN</button>
                                    <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i>RESET</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
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

<script>
    $(document).ready(function(){

        var province_id = '{{ old('province_id',Auth::user()->province_id) }}';
        var regencies_id = '{{ old('regencies_id',Auth::user()->regencies_id) }}';
       
        if(province_id){
            $.ajax({
                url : "{{ url('/') }}/user/regencies/"+province_id,
                type : "GET",
                dataType : "JSON",
                success : function(data){
                    $('#regencies_id').empty();
                    $('#regencies_id').append('<option value="">Pilih Kota</option>');

                    $.each(data, function(key, value){
                        $('#regencies_id').append(`<option value="${value.id}" ${value.id == regencies_id ? "selected" : ""} >${value.name}</option>`);
                    });
                }
            });
        }

        $('#select').change(function(){
            var province_id = $(this).val();
            $.ajax({
                url : "{{ url('/') }}/user/regencies/"+province_id,
                type : "GET",
                dataType : "JSON",
                success : function(data){
                    $('#regencies_id').empty();
                    $('#regencies_id').append('<option value="">Pilih Kota</option>');

                    $.each(data, function(key, value){
                        $('#regencies_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                }
            });
        });
    });
</script>

@endpush