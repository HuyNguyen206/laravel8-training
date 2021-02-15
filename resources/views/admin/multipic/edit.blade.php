@extends('admin.admin_master')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Edit Brand <br>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto">
                @if(session('success'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        </div>

                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Edit Brand
                            </div>
                            <div class="card-body">
                                <form action="{{route('brands.update', $brand->id)}}" class="form" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label for="category">Brand</label>
                                        <input type="text" name="name" id="name" value="{{old('name', $brand->name)}}" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image_path">Image</label>
                                        <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror">
                                        @isset($brand->image_path)
                                            <img src="{{asset('storage/'.$brand->image_path)}}" alt="">
                                        @endisset
                                        @error('image_path')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update brand</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
