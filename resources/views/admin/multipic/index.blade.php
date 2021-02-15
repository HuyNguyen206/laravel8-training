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
                                All picture
                            </div>
                            <div class="bg-white overflow-hidden shadow-xl">
                                {{-- <x-jet-welcome /> --}}
                                <table class="border-collapse border border-solid w-full shadow-md">
                                    <thead>
                                    <tr>
                                        <th class="border  p-2">STT</th>
                                        <th class="border  p-2">Image</th>
                                        <th class="border  p-2">Created at</th>
                                        <th class="border  p-2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @php($i = ($currentPage - 1)*5 + 1)--}}
                                                            @forelse($images as $i)
                                                                <tr>
                                                                    <td class="border  p-2 pl-3">{{$images->firstItem() + $loop->index}}</td>
                                                                    <td class="border  p-2 pl-3"><img style="width:50px;" src="{{asset('storage/'.$i->image_path)}}" alt=""></td>
                                                                    <td class="border  p-2 pl-3">{{$i->created_at->diffForHumans()}}</td>
                                                                    <td class="border  p-2 pl-3">
                                                                        <div class="btn btn-group">
                                                                            <a href="" class="btn btn-info">
                                                                                Edit
                                                                            </a>
                                                                            <a href="" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">
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
                                Add pic
                            </div>
                            <div class="card-body">
                                <form action="{{route('multipic.store')}}" class="form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="image_path">Image</label>
                                        <input multiple type="file" name="image_path[]" class="form-control @error('image_path') is-invalid @enderror">
                                        @error('image_path')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add pic</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $images->links() !!}
                        </div>
                    </div>
            </div>

        </div>
    </div>
@endsection
