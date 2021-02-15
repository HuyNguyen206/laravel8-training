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
                        <div class="card">
                            <div class="card-header">
                                Edit Category
                            </div>
                            <div class="card-body">
                                <form action="{{route('category.update', $category->id)}}" class="form" method="post">
                                    @method('patch')
                                    @csrf
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <input type="text" name="category" id="category" value="{{old('category', $category->category)}}" class="form-control @error('category') is-invalid @enderror">
                                        @error('category')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
