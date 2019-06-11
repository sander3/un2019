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
        $options = ['do_links' => 'none'];

        $text = (new Html2Text($content, $options))
            ->getText();

        return $next($text);
    }
}
