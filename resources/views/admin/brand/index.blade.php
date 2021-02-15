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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                All brands
                            </div>
                            <div class="bg-white overflow-hidden shadow-xl">
                                {{-- <x-jet-welcome /> --}}
                                <table class="border-collapse border border-solid w-full shadow-md">
                                    <thead>
                                    <tr>
                                        <th class="border  p-2">STT</th>
                                        <th class="border  p-2">Name</th>
                                        <th class="border  p-2">Image</th>
                                        <th class="border  p-2">Created at</th>
                                        <th class="border  p-2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @php($i = ($currentPage - 1)*5 + 1)--}}
                                                            @forelse($brands as $b)
                                                                <tr>
                                                                    <td class="border  p-2 pl-3">{{$brands->firstItem() + $loop->index}}</td>
                                                                    <td class="border  p-2 pl-3">{{$b->name}}</td>
                                                                    <td class="border  p-2 pl-3"><img style="width:50px;" src="{{asset('storage/'.$b->image_path)}}" alt=""></td>
                                                                    <td class="border  p-2 pl-3">{{$b->created_at->diffForHumans()}}</td>
                                                                    <td class="border  p-2 pl-3">
                                                                        <div class="btn btn-group">
                                                                            <a href="{{route('brands.edit', $b->id)}}" class="btn btn-info">
                                                                                Edit
                                                                            </a>
                                                                            <a href="{{route('brands.destroy', $b->id)}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="4" class="border  p-2 pl-3 text-center">
                                                                        No data
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add brand
                            </div>
                            <div class="card-body">
                                <form action="{{route('brands.store')}}" class="form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Brand</label>
                                        <input type="text" name="name" id="name" value="{{old('name', '')}}" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image_path">Image</label>
                                        <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror">
                                        @error('image_path')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add brand</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $brands->links() !!}
                        </div>
                    </div>
            </div>

        </div>
    </div>
@endsection
