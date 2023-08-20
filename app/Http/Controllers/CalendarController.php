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
        $emotions = DailyEmotion::where('user_id', $user->id)->get();
        $events = [];
        
        foreach ($emotions as $emotion) {
            $events[] = [
                'title' => 'Emotion: ' . $emotion->emotion_id,
                'start' => 'Date: ' . $emotion->created_at,
                'className' => 'emoji-event',
            ];
        }
        
        foreach ($events as $event) {
            $emoji = '';
            
            if (strpos($event['title'], 'Emotion: 1') !== false) {
                $emoji = '😀';
            } elseif (strpos($event['title'], 'Emotion: 2') !== false) {
                $emoji = '😞';
            } elseif (strpos($event['title'], 'Emotion: 3') !== false) {
                $emoji = '😡';
            } elseif (strpos($event['title'], 'Emotion: 4') !== false) {
                $emoji = '🙂';
            } elseif (strpos($event['title'], 'Emotion: 4') !== false) {
                $emoji = '😏';
            }
            
            $event['title'] = $emoji;
            $eventsWithEmojis[] = $event; 
            
        }
        // dd($eventsWithEmojis);
        return view('calendar', ['events' => $eventsWithEmojis]);


    }

}
