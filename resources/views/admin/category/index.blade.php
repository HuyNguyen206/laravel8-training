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
                                All category
                            </div>
                            <div class="bg-white overflow-hidden shadow-xl">
                                {{-- <x-jet-welcome /> --}}
                                <table class="border-collapse border border-solid w-full shadow-md">
                                    <thead>
                                    <tr>
                                        <th class="border  p-2">STT</th>
                                        <th class="border  p-2">Name</th>
                                        <th class="border  p-2">User</th>
                                        <th class="border  p-2">Created at</th>
                                        <th class="border  p-2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @php($i = ($currentPage - 1)*5 + 1)--}}
                                                            @forelse($categories as $c)
                                                                <tr>
                                                                    <td class="border  p-2 pl-3">{{$categories->firstItem() + $loop->index}}</td>
                                                                    <td class="border  p-2 pl-3">{{$c->category}}</td>
                                                                    <td class="border  p-2 pl-3">{{$c->user->name}}</td>
                                                                    <td class="border  p-2 pl-3">{{$c->created_at->diffForHumans()}}</td>
                                                                    <td class="border  p-2 pl-3">
                                                                        <div class="btn btn-group">
                                                                            <a href="{{route('category.edit', $c->id)}}" class="btn btn-info">
                                                                                Edit
                                                                            </a>
                                                                            <a href="{{route('category.delete', $c->id)}}" class="btn btn-danger">
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
                                Add Category
                            </div>
                            <div class="card-body">
                                <form action="{{route('category.store')}}" class="form" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <input type="text" name="category" id="category" value="{{old('category', '')}}" class="form-control @error('category') is-invalid @enderror">
                                        @error('category')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! $categories->links() !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                   Trash category
                                </div>
                                <div class="bg-white overflow-hidden shadow-xl">
                                    {{-- <x-jet-welcome /> --}}
                                    <table class="border-collapse border border-solid w-full shadow-md">
                                        <thead>
                                        <tr>
                                            <th class="border  p-2">STT</th>
                                            <th class="border  p-2">Name</th>
                                            <th class="border  p-2">User</th>
                                            <th class="border  p-2">Created at</th>
                                            <th class="border  p-2">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--                                    @php($i = ($currentPage - 1)*5 + 1)--}}
                                        @forelse($trashCategories as $c)
                                            <tr>
                                                <td class="border  p-2 pl-3">{{$trashCategories->firstItem() + $loop->index}}</td>
                                                <td class="border  p-2 pl-3">{{$c->category}}</td>
                                                <td class="border  p-2 pl-3">{{$c->user->name}}</td>
                                                <td class="border  p-2 pl-3">{{$c->created_at->diffForHumans()}}</td>
                                                <td class="border  p-2 pl-3">
                                                    <div class="btn btn-group">
                                                        <a href="{{route('category.restore', $c->id)}}" class="btn btn-success">
                                                            Restore
                                                        </a>
                                                        <a href="{{route('category.forceDelete', $c->id)}}" class="btn btn-danger">
                                                            Force Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="border  p-2 pl-3 text-center">
                                                    No data
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $trashCategories->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
    </div>
@endsection
