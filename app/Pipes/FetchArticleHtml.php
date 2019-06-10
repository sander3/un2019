<?php

namespace App\Pipes;

use Closure;
use Spatie\Browsershot\Browsershot;

class FetchArticleHtml implements Pipe
{
    public function handle(
        $url,
        Closure $next
    ) {
        $browsershot = Browsershot::url($url);

        if ($path = config('browsershot.include_path')) {
            $browsershot->setIncludePath($path);
        }

        $html = $browsershot
            ->waitUntilNetworkIdle(false) // 2 network connections, 500ms
            ->bodyHtml();

        return $next([
            'url'  => $url,
            'html' => $html,
        ]);
    }
}
