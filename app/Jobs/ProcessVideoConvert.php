<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Feedback;
use \FFMpeg;

class ProcessVideoConvert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $feedback;
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $feedback = $this->feedback;
        $file = substr($feedback->video, 0, -4);
        FFMpeg::fromDisk('public')
            ->open('videos/'.$file.'.webm')
            ->export()
            ->toDisk('public')
            ->inFormat(new FFMpeg\Format\Video\X264('libmp3lame', 'libx264'))
            ->save('videos/'.$feedback->video);
    }
}
