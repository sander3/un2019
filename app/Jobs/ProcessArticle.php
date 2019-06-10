<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Pipes\FetchArticleHtml;
use Illuminate\Pipeline\Pipeline;
use App\Pipes\ConvertTextToSpeech;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Pipes\ConvertArticleContentToText;
use App\Pipes\ConvertArticleHtmlToContent;
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
        $pipes = [
            FetchArticleHtml::class,
            ConvertArticleHtmlToContent::class,
            ConvertArticleContentToText::class,
            ConvertTextToSpeech::class,
        ];

        app(Pipeline::class)
            ->send($this->url)
            ->through($pipes)
            ->thenReturn();
    }
}
