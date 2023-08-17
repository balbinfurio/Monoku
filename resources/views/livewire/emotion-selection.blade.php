<div>
    @if(session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <h2>Selecciona tu emoción del día</h2>
    <form wire:submit.prevent="saveEmotion">
        @csrf
        <select id="selectedEmotion" name="selectedEmotion" wire:model="selectedEmotion">
            <option value="">Seleccione una emoción</option>
            @foreach($emotions as $emotion)
                <option value="{{ $emotion->id }}">{{ $emotion->name }}</option>
            @endforeach
        </select>
        <button type="submit" id="submitEmotion">Guardar</button>
    </form>
</div>
