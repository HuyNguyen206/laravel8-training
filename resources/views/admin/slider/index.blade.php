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
                        <div class="col">
                            <a href="{{route('sliders.create')}}" class="btn btn-primary btn-md">
                                Add slider
                            </a>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card w-100">
                            <div class="card-header">
                                All slider
                            </div>
                            <div class="bg-white overflow-hidden shadow-xl">
                                {{-- <x-jet-welcome /> --}}
                                <table class="border-collapse border border-solid w-100 shadow-md">
                                    <thead>
                                    <tr>
                                        <th class="border  p-2">STT</th>
                                        <th class="border  p-2">Title</th>
                                        <th class="border  p-2">Description</th>
                                        <th class="border  p-2">Image</th>
                                        <th class="border  p-2">Created at</th>
                                        <th class="border  p-2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @php($i = ($currentPage - 1)*5 + 1)--}}
                                                            @forelse($sliders as $slider)
                                                                <tr>
                                                                    <td class="border  p-2 pl-3">{{$sliders->firstItem() + $loop->index}}</td>
                                                                    <td class="border  p-2 pl-3">{{$slider->title}}</td>
                                                                    <td class="border  p-2 pl-3"><img style="width:50px;" src="{{asset('storage/'.$slider->image_path)}}" alt=""></td>
                                                                    <td class="border  p-2 pl-3">{{$slider->created_at->diffForHumans()}}</td>
                                                                    <td class="border  p-2 pl-3">
                                                                        <div class="btn btn-group">
                                                                            <a href="{{route('sliders.edit', $slider->id)}}" class="btn btn-info">
                                                                                Edit
                                                                            </a>
                                                                            <a href="{{route('sliders.destroy', $slider->id)}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">
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
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $sliders->links() !!}
                        </div>
                    </div>
            </div>

        </div>
    </div>
@endsection
