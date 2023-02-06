@extends('layouts.admin', ['title' => 'Dashboard Admin'])

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transactions</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-dollar-sign"></i> Transactions {{ $transaction->code }}</h4>
                </div>

                <div class="card-body">
                  
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.transactions.update',$transaction->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    @foreach ($transaction->transaction_details as $item)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Nama Barang</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $item->product->name }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Harga</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $item->price }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Quantity</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $item->quantity }}" readonly>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ old('name',$transaction->name) }}" placeholder="Masukkan Name"
                                            class="form-control @error('name') is-invalid @enderror">
            
                                        @error('name')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="number" name="phone" value="{{ old('phone',$transaction->phone) }}" placeholder="Masukkan Phone Number"
                                            class="form-control @error('phone') is-invalid @enderror">
            
                                        @error('phone')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" id="address" class="form-control address" placeholder="Masukkan Address" cols="30" rows="5">{{ old('address',$transaction->address) }}
                                      </textarea>
            
                                        @error('address')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                  {{-- Provinsi --}}
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select name="province_id" id="province_id" class="form-control @error('province_id') is-invalid @enderror">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" {{ $transaction->province_id == $province->id ? 'selected' : '' }}>
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
                                    <div class="form-group">
                                        <label>Kode Pos</label>
                                        <input type="text" name="kode_pos" value="{{ old('kode_pos',$transaction->kode_pos) }}" placeholder="Masukkan Kode Pos"
                                            class="form-control @error('kode_pos') is-invalid @enderror">
            
                                        @error('kode_pos')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Total Price</label>
                                        <input type="text" name="total_price" value="{{ old('total_price',$transaction->total_price) }}" placeholder="Masukkan Total Price"
                                            class="form-control @error('total_price') is-invalid @enderror">
            
                                        @error('total_price')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">No. Resi</label>
                                        <input type="text" name="resi" value="{{ old('resi',$transaction->resi) }}" class="form-control @error('resi') is-invalid @enderror" placeholder="Masukan Nomor Resi">
                                        @error('resi')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Pengiriman</label>
                                        <select name="status_pengiriman" id="status" class="form-control @error('status_pengiriman') is-invalid @enderror">
                                            <option value="">Pilih Status</option>
                                            <option value="PENDING" {{ $transaction->status_pengiriman == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                            <option value="SUCCESS" {{ $transaction->status_pengiriman == 'SUCCESS' ? 'selected' : '' }}>Success</option>
                                            <option value="SHIPPING" {{ $transaction->status_pengiriman == 'SHIPPING' ? 'selected' : '' }}>Shipping</option>
                                            <option value="CANCEL" {{ $transaction->status_pengiriman == 'CANCEL' ? 'selected' : '' }}>Cancel</option>
                                        </select>
                                        @error('status_pengiriman')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status Pembayaran</label>
                                        <select name="status" id="select" class="form-control @error('status') is-invalid @enderror">
                                            <option value="">Pilih Status</option>
                                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="success" {{ $transaction->status == 'success' ? 'selected' : '' }}>Success</option>
                                            <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
            
                                        @error('status')
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
                </div>
            </div>
        </div>

    </section>
</div>


@endsection

@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>

<script>
     //active select2
     $(document).ready(function () {
         $('select').select2({
             theme: 'bootstrap4',
             width: 'style',
         });
     });
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

        var province_id = '{{ old('province_id',$transaction->province_id) }}';
        var regencies_id = '{{ old('regencies_id',$transaction->regencies_id) }}';
       
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

        $('#province_id').change(function(){
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

