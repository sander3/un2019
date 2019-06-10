<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TwilioWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $credentials = [
        //     config('services.twilio.sid'),
        //     config('services.twilio.token'),
        // ];

        // $client = new TwilioClient(...$credentials);

        $url = Storage::disk('public')->url('output.mp3');

        $response = new VoiceResponse;
        $response->play($url);
        $response->hangup();

        return $response;
    }
}
