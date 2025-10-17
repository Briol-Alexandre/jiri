<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProcessUploadedContactAvatar implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $full_path_to_original,
        public string $new_original_file_name
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $image = Image::read(
            Storage::get($this->full_path_to_original)
        );

        $sizes = config('contactavatars.sizes');
        $jpeg_compression = config('contactavatars.jpeg_compression');
        $variant_pattern = config('contactavatars.variant_pattern');
        $image_type = config('contactavatars.image_type');

        foreach ($sizes as $size) {
            $variant = clone $image;
            $variant
                ->scale($size['width']);

            $path = sprintf($variant_pattern, $size['width'], $size['height']);
            info('toto');
            Storage::put($path . '/' . $this->new_original_file_name, $variant->encodeByExtension($image_type, $jpeg_compression));
        }
    }
}
