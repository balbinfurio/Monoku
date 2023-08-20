<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DailyEmotion;
use App\Models\Emotion;
use App\Models\JournalEntry;
use \OpenAI;
use Illuminate\Http\Request;

class EmotionSelection extends Component
{
    public $selectedEmotion;
    public $emotions;
    public $writtenEntry;
    public $openAIResponse;


    public function mount()
    {
        $this->emotions = Emotion::all();
    }
    
    public function saveEmotion(Request $request)
    {
        // Verificar si ya existe un registro para el usuario en el día actual
        $dailyEmotion = DailyEmotion::where('user_id', auth()->user()->id)
        ->whereDate('created_at', now()->format('Y-m-d'))
        ->first();

        if ($dailyEmotion) {
            return redirect()->back()->with('error', 'You have already registered your thoughts today.');
        }

        // Guardar emoción y entrada en la base de datos
        $dailyEmotion = new DailyEmotion();
        $dailyEmotion->user_id = auth()->user()->id;
        $dailyEmotion->emotion_id = $this->selectedEmotion;
        $dailyEmotion->journal_entry = $this->writtenEntry;
        
        // Realizar la solicitud a la API de OpenAI
        $yourApiKey = env('OPENAI_API_KEY');
        $client = OpenAI::client($yourApiKey);
        
        $result = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $this->writtenEntry,
            'max_tokens' => 50
        ]);
        
        $dailyEmotion->OpenAI = $result['choices'][0]['text'];
        $dailyEmotion->save();
        
        $this->reset(['selectedEmotion', 'writtenEntry']);
        
        session()->flash('message', 'Your thoughts have been saved.');
    }

    public function getOpenAI()
    {
        $dailyEmotion = DailyEmotion::where('user_id', auth()->user()->id)
            ->whereDate('created_at', now()->toDateString())
            ->first();
            
        
        if ($dailyEmotion) {
            $this->openAIResponse = $dailyEmotion->OpenAI;
        }
    
        // dd($this->openAIResponse);

    }
    
    public function render()
    {
        return view('livewire.emotion-selection', );
    }
}
