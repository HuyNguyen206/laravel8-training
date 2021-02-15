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
                                Update about page
                            </div>
                            <div class="bg-white overflow-hidden shadow-xl">
                                <form enctype="multipart/form-data" action="{{route('abouts.update', $about->id)}}" method="post" class="form p-2">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" name="title" value="{{old('title', $about->title)}}" class="form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Short Description</label>
                                        <textarea name="short_dis"   class="form-control @error('short_dis') is-invalid @enderror">{{old('short_dis', $about->short_dis)}}</textarea>
                                        @error('short_dis')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Long Description</label>
                                        <textarea name="long_dis"  class="form-control @error('long_dis') is-invalid @enderror">{{old('long_dis', $about->long_dis)}}</textarea>
                                        @error('long_dis')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-outline-secondary">
                                        Update about page
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
