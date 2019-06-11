<?php

namespace App\Pipes;

use Closure;
use andreskrey\Readability\Readability;
use andreskrey\Readability\Configuration;

class ConvertArticleHtmlToContent implements Pipe
{
    public function handle(
        $content,
        Closure $next
    ) {
        $configuration = (new Configuration)
            ->setFixRelativeURLs(true)
            ->setOriginalURL($content['url'])
            ->setWordThreshold(600);

        $readability = new Readability($configuration);

        $readability->parse($content['html']);

        $html = $readability->getContent();

        return $next($html);
    }
}
