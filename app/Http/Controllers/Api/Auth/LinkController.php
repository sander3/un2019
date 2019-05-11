<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Soved\Laravel\Magic\Auth\Links\LinkBroker;
use Soved\Laravel\Magic\Auth\SendsMagicLinkEmails;

class LinkController extends Controller
{
    use SendsMagicLinkEmails;

    /**
     * Get the response for a successfully sent magic link.
     *
     * @param  string  $response
     * @return array
     */
    protected function sendMagicLinkResponse(string $response)
    {
        return ['status' => __($response)];
    }

    /**
     * Get the response for a failed magic link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Validation\ValidationException
     */
    protected function sendMagicLinkFailedResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => __(LinkBroker::INVALID_USER),
        ]);
    }
}
