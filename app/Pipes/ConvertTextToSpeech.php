<?php

namespace App\Pipes;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

class ConvertTextToSpeech
{
    public function handle(
        $content,
        Closure $next
    ) {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . storage_path('app/UN2019-beeba9a4336e.json'));

        $client = new TextToSpeechClient;

        $truncated = Str::limit($content, 4997);

        $truncated = str_replace('*', '-', $truncated);

        $synthesisInputText = (new SynthesisInput)
            ->setText($truncated);

        $voice = (new VoiceSelectionParams)
            ->setLanguageCode('en-US')
            ->setSsmlGender(SsmlVoiceGender::NEUTRAL);

        $effectsProfileId = 'handset-class-device';

        $audioConfig = (new AudioConfig)
            ->setAudioEncoding(AudioEncoding::MP3)
            ->setEffectsProfileId([$effectsProfileId]);

        $response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
        $audioContent = $response->getAudioContent();

        Storage::disk('public')->put('output.mp3', $audioContent);

        return $next($content);
    }
}
