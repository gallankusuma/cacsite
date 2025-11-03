<?php
namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait Uploads {
    protected function putUpload(?UploadedFile $file, string $dir, array $allowedMimes = []): ?string {
        if (!$file) return null;

        if ($allowedMimes && !in_array($file->getClientMimeType(), $allowedMimes)) {
            throw new \RuntimeException('Invalid file type');
        }

        $name = Str::random(20).'.'.$file->getClientOriginalExtension();
        return $file->storeAs($dir, $name, 'public');
    }
}
