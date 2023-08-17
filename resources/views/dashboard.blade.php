<x-app-layout>
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
            <h2>Selecciona tu emoción del día</h2>
            <form method="post" action="{{ route('save-emotion') }}">
                @csrf
                <select name="selected_emotion">
                    @foreach($emotions as $emotion)
                    <option value="{{ $emotion->id }}">{{ $emotion->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
