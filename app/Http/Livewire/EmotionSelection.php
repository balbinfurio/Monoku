<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DailyEmotion;
use App\Models\Emotion;

class EmotionSelection extends Component
{
    public $selectedEmotion;
    public $emotions;

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
        // Otros campos necesarios
        $dailyEmotion->save();
        
        
        $this->reset(['selectedEmotion']); // Limpia el valor seleccionado

        session()->flash('message', 'Emoción guardada exitosamente.');

        // Puedes emitir un evento para notificar a otros componentes sobre cambios
        // $this->emit('emotionSaved');

        // $this->emitSelf('refreshComponent'); // Refrescar este componente
    }


    public function render()
    {
        return view('livewire.emotion-selection');
    }
}
