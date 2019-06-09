<?php

namespace App\Jobs;

use Html2Text\Html2Text;
use Illuminate\Bus\Queueable;
use Spatie\Browsershot\Browsershot;
use Illuminate\Queue\SerializesModels;
use andreskrey\Readability\Readability;
use Illuminate\Queue\InteractsWithQueue;
use andreskrey\Readability\Configuration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    public $url;

    /**
     * Create a new job instance.
     *
     * @param  string  $url
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $browsershot = Browsershot::url($this->url);

        if ($path = config('browsershot.include_path')) {
            $browsershot->setIncludePath($path);
        }

        $html = $browsershot
            ->waitUntilNetworkIdle(false) // 2 network connections, 500ms
            ->bodyHtml();

        //

        $configuration = (new Configuration)
            ->setFixRelativeURLs(true)
            ->setOriginalURL($this->url);

        $readability = new Readability($configuration);

        $readability->parse($html);

        $content = $readability->getContent();

        //

        $article = (new Html2Text($content))
            ->getText();
    }
}
