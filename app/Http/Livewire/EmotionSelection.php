<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DailyEmotion;
use App\Models\Emotion;
use App\Models\JournalEntry;

class EmotionSelection extends Component
{
    public $selectedEmotion;
    public $emotions;
    public $writtenEntry;

    public function mount()
    {
        $this->emotions = Emotion::all(); // Obtén las emociones desde tu modelo Emotion
    }
    
    public function saveEmotion()
    {
        
        // dd('Método saveEmotion está siendo llamado');
        $dailyEmotion = new DailyEmotion();
        $dailyEmotion->user_id = auth()->user()->id;
        $dailyEmotion->emotion_id = $this->selectedEmotion;

        $dailyEmotion->journal_entry = $this->writtenEntry;
        // dd($this->writtenEntry);

        $dailyEmotion->save();
        
        
        $this->reset(['selectedEmotion']);
        // $this->reset(['writtenEntry']);

        session()->flash('message', 'Registros guardados exitosamente.');

    }


    public function render()
    {
        return view('livewire.emotion-selection');
    }
}
