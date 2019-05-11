<?php

namespace App\Http\Requests;

use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    /**
     * Determine if the current request is asking for JSON.
     *
     * @return bool
     */
    public function wantsJson()
    {
        return true;
    }
}
