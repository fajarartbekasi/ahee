@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-3">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h5>Silahkan isi data testimoni disini.</h5>
                        </div>

                        <form action="{{route('testimoni.update', $testimoni->id)}}" method="POST" enctype="multipart/form-data" class="was-validated">
                            @csrf
                            @method('PATCH')
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success')}}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" name="name" id="" value="{{$testimoni->name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="images" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>

                                            <span class="text-danger">File harus png</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-info">Simpan mitra</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection