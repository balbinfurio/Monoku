<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \OpenAI;
use Inertia\Inertia;

class OpenAIController extends Controller
{
    public function index()
    {
        return Inertia::render('Index');
    }

    public function makeRequest(Request $request)
    {
        $yourApiKey = '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';
        $client = OpenAI::client($yourApiKey);

        $result = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $request->prompt,
            'max_tokens' => 5
        ]);

        return $result['choices'][0]['text'];
    }
}