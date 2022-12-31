<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                        @if(Auth::user()->name || Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="" style="height:400px;width:400px">
        <h1>{{ Auth()::user()->name }}</h1>
        @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
