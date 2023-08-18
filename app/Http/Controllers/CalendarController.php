<?php

namespace App\Http\Controllers;

use App\Models\DailyEmotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $emotions = DailyEmotion::where('user_id', $user->id)->get(); // Obtén los registros solo para ese usuario
        // Formatea los registros en un formato compatible con FullCalendar
        $events = [];
        
        foreach ($emotions as $emotion) {
            $events[] = [
                'title' => 'Emotion: ' . $emotion->emotion_id,
                'start' => 'Date: ' . $emotion->created_at,
            ];
        }
        
        foreach ($events as $event) {
            $emoji = ''; // Variable para almacenar el emoji correspondiente
            
            if (strpos($event['title'], 'Emotion: 1') !== false) {
                $emoji = '😀'; // Emoji correspondiente al título "Emotion: 1"
            } elseif (strpos($event['title'], 'Emotion: 2') !== false) {
                $emoji = '😄'; // Emoji correspondiente al título "Emotion: 2"
            } elseif (strpos($event['title'], 'Emotion: 3') !== false) {
                $emoji = '😊'; // Emoji correspondiente al título "Emotion: 3"
            }
            
            $event['title'] = $emoji; // Agregar el emoji al título
            $eventsWithEmojis[] = $event; // Agregar el evento modificado al nuevo array
            
        }
        // dd($eventsWithEmojis);
        return view('calendar', ['events' => $eventsWithEmojis]);


        // return view('calendar', ['events' => $events]);
    }

}
