<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesUpload
{
    /**
     * Upload a single file (image or any file).
     */
   public function uploadFile($file, string $directory = 'uploads', string $disk = 'public'): ?string
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        // Get the original file name provided by the user
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        
        // Get the file extension
        $extension = $file->getClientOriginalExtension();

        // Generate a random 4-digit number
        $randomNum = rand(1000, 9999);

        // Combine the original name, random number, and extension: original-name-1234.ext
        $filename = "{$originalName}-{$randomNum}.{$extension}";

        return $file->storeAs($directory, $filename, $disk);
    }

    /**
     * Upload multiple files.
     */
    public function uploadFiles(array $files, string $directory = 'uploads', string $disk = 'public'): array
    {
        return array_map(fn($file) => $this->uploadFile($file, $directory, $disk), $files);
    }

    /**
     * Delete a file.
     */
    public function deleteFile(?string $path, string $disk = 'public'): bool
    {
        return $path && Storage::disk($disk)->exists($path)
            ? Storage::disk($disk)->delete($path)
            : false;
    }

    /**
     * Get file URL.
     */
    public function getFileUrl(?string $path, string $disk = 'public'): ?string
    {
        return $path ? Storage::disk($disk)->url($path) : null;
    }

    /**
     * --- Aliases for backward compatibility (no duplication) ---
     */
    public function uploadImage($image, string $directory = 'uploads/images', string $disk = 'public'): ?string
    {
        return $this->uploadFile($image, $directory, $disk);
    }

    public function uploadImages(array $images, string $directory = 'uploads/images', string $disk = 'public'): array
    {
        return $this->uploadFiles($images, $directory, $disk);
    }

    public function deleteImage(?string $path, string $disk = 'public'): bool
    {
        return $this->deleteFile($path, $disk);
    }

    public function getImageUrl(?string $path, string $disk = 'public'): ?string
    {
        return $this->getFileUrl($path, $disk);
    }
}
