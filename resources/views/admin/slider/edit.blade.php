@extends('admin.admin_master')
@section('content')
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
                        <div class="card w-100">
                            <div class="card-header">
                                Update slider
                            </div>
                            <div class="bg-white overflow-hidden shadow-xl">
                                <form enctype="multipart/form-data" action="{{route('sliders.update', $slider->id)}}" method="post" class="form p-2">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" name="title" value="{{old('title', $slider->title)}}" class="form-control @error('title') is-invalid @enderror"">
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description"  class="form-control @error('description') is-invalid @enderror"">{{old('description', $slider->description)}}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror"">
                                        @error('image_path')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <img style="object-fit: contain;width: 301px" src="{{asset('storage/'.$slider->image_path)}}" alt="">
                                    </div>
                                    <button class="btn btn-outline-secondary">
                                        Update slider
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
