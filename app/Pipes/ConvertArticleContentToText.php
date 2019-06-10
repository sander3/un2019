<?php

namespace App\Pipes;

use Closure;
use Html2Text\Html2Text;

class ConvertArticleContentToText
{
    public function handle(
        $content,
        Closure $next
    ) {
        $text = (new Html2Text($content))
            ->getText();

        return $next($text);
    }
}
