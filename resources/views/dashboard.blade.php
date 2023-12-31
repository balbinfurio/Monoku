<x-app-layout>
    @livewireScripts
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    {{-- <div class="mt-4">
        @dd($emotions)
    </div> --}}
    
    <div class="container">
        <div class="mt-4">
            <div class="mt-4">
                @livewire('emotion-selection')
            </div>
        </div>
    </div>

    <div class="py-12" id="footer">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ 'Contact' }}" class="block p-6 text-gray-900 hover:text-blue-500">
                    {{ __("Contact us ©") }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
