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
        $yourApiKey = "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";
        $client = OpenAI::client($yourApiKey);

        $result = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $request->prompt,
            'max_tokens' => 1000
        ]);

        return $result['choices'][0]['text'];
    }
}
