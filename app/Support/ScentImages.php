<?php

namespace App\Support;

class ScentImages
{
    public static function url(string $key): string
    {
        $basePath = trim((string) config('scentlab.base_path', 'images/scent-lab'), '/');
        $filename = (string) config("scentlab.images.{$key}", 'placeholder.png');

        return asset($basePath.'/'.$filename);
    }

    public static function all(): array
    {
        $images = (array) config('scentlab.images', []);

        return collect($images)
            ->mapWithKeys(fn (string $filename, string $key): array => [
                $key => self::url($key),
            ])->toArray();
    }
}
