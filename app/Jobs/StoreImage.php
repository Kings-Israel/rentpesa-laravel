<?php

namespace App\Jobs;

use Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;
    public $directory;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $directory)
    {
        $this->file = $file;
        $this->directory = $directory;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $image = $this->file;
      $input['imagename'] = time().'.'.$image->extension();

      $filePath = public_path('storage/'.$this->directory);
      $img = Image::make($image->path());
      $img->resize(700, 464, function($const) {
        $const->aspectRatio();
      })->save($filePath.'/'.$input['imagename']);
//      $event->event_poster = $img->basename;
      return $img->basename;
    }
}
