<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DailyEmotion;
use App\Models\Emotion;
use App\Models\JournalEntry;
use \OpenAI;
use Illuminate\Http\Request; // Agrega esta línea

class EmotionSelection extends Component
{
    public $selectedEmotion;
    public $emotions;
    public $writtenEntry;

    public function mount()
    {
        $this->emotions = Emotion::all();
    }
    
    public function saveEmotion(Request $request)
    {
        // Guardar emoción y entrada en la base de datos
        $dailyEmotion = new DailyEmotion();
        $dailyEmotion->user_id = auth()->user()->id;
        $dailyEmotion->emotion_id = $this->selectedEmotion;
        $dailyEmotion->journal_entry = $this->writtenEntry;
        $dailyEmotion->save();
        
        // Realizar la solicitud a la API de OpenAI
        $yourApiKey = "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";
        $client = OpenAI::client($yourApiKey);
        
        $result = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $this->writtenEntry,
            'max_tokens' => 5
        ]);

        // Aquí podrías guardar la respuesta de OpenAI en una base de datos si deseas
        // $journalEntry = new JournalEntry();
        // $journalEntry->user_id = auth()->user()->id;
        // $journalEntry->response_from_openai = $result['choices'][0]['text'];
        // $journalEntry->save();
        
        $this->reset(['selectedEmotion', 'writtenEntry']);
        
        session()->flash('message', 'Registros guardados exitosamente.');
    }
    
    public function render()
    {
        return view('livewire.emotion-selection');
    }
}


// class EmotionSelection extends Component
// {
//     public $selectedEmotion;
//     public $emotions;
//     public $writtenEntry;

//     public function mount()
//     {
//         $this->emotions = Emotion::all(); // Obtén las emociones desde tu modelo Emotion
//     }
    
//     public function saveEmotion()
//     {
        
//         // dd('Método saveEmotion está siendo llamado');
//         $dailyEmotion = new DailyEmotion();
//         $dailyEmotion->user_id = auth()->user()->id;
//         $dailyEmotion->emotion_id = $this->selectedEmotion;
//         $dailyEmotion->journal_entry = $this->writtenEntry;
//         // dd($this->writtenEntry);

//         $dailyEmotion->save();
        
        
//         $this->reset(['selectedEmotion']);
//         // $this->reset(['writtenEntry']);

//         session()->flash('message', 'Registros guardados exitosamente.');

//     }


//     public function render()
//     {
//         return view('livewire.emotion-selection');
//     }
// }