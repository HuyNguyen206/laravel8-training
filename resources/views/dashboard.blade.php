<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} <br>
            Hi {{auth()->user()->name}}!
        </h2>
        <h6>
            There are <span class="badge badge-info">{{count($users)}}</span> users in our system
        </h6>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto">
                <div class="bg-white overflow-hidden shadow-xl">
                    {{-- <x-jet-welcome /> --}}
                    <table class="border-collapse border border-solid w-full shadow-md">
                        <thead>
                        <tr>
                            <th class="border  p-2">STT</th>
                            <th class="border  p-2">Name</th>
                            <th class="border  p-2">Email</th>
                            <th class="border  p-2">Created at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td class="border  p-2 pl-3">{{$loop->iteration}}</td>
                                <td class="border  p-2 pl-3">{{$u->name}}</td>
                                <td class="border  p-2 pl-3">{{$u->email}}</td>
                                <td class="border  p-2 pl-3">{{$u->created_at->diffForHumans()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
