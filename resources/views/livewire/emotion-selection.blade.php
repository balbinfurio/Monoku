<div>
    @if(session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <div class="flex justify-center items-center">
        <div id="dash-first">
            <h2 class="text-3xl font-semibold text-center mb-5">HOW DO YOU FEEL TODAY?</h2>
            <form wire:submit.prevent="saveEmotion">
                @csrf
                <div class="flex gap-4">
                    <button type="button" wire:click="$set('selectedEmotion', 1)" class="text-9xl @if($selectedEmotion === 1) selected-emoji @endif" title="HAPPY">😀</button>
                    <button type="button" wire:click="$set('selectedEmotion', 2)" class="text-9xl @if($selectedEmotion === 2) selected-emoji @endif" title="SAD">😞</button>
                    <button type="button" wire:click="$set('selectedEmotion', 3)" class="text-9xl @if($selectedEmotion === 3) selected-emoji @endif" title="ANGRY">😡</button>
                    <button type="button" wire:click="$set('selectedEmotion', 4)" class="text-9xl @if($selectedEmotion === 4) selected-emoji @endif" title="CALM">🙂</button>
                    <button type="button" wire:click="$set('selectedEmotion', 5)" class="text-9xl @if($selectedEmotion === 5) selected-emoji @endif" title="EXCITED">😏</button>
                </div>
            </form>
        </div>
    </div>
    
    
    <div class="flex justify-center items-center">
        <div id="dash-sec">
            <div>
                <h2 class="text-3xl font-semibold text-center mb-5">SHOW ME YOUR THOUGHS</h2>
                <form wire:submit.prevent="saveEmotion">
                    <textarea id="text-entry" class="w-96 h-48 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 placeholder-gray-400" 
                        wire:model="writtenEntry" 
                        maxlength="256" 
                        placeholder="Enter your thoughts...">
                    </textarea>

                    <button type="submit" id="submitEmotion" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out">
                        SAVE
                    </button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
