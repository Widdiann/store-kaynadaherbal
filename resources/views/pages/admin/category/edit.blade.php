@extends('layouts.admin', ['title' => 'Dashboard Admin Category Create'])

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Categories</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Edit Category</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                     <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name Category</label>
                                <input type="text" name="name" value="{{ old('name',$category->name) }}" placeholder="Masukkan Name Category"
                                    class="form-control @error('name') is-invalid @enderror">
    
                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Photo</label> <br>
                                <img src="{{ asset('storage/'.$category->photo) }}" alt="" width="100px" height="100px">
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

