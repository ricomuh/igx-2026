<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageOptimizer
{
    /**
     * Compress image to Full HD max (1920px) and convert to WebP.
     * Overwrites original file with WebP version.
     */
    public function optimize(string $disk, string $path, int $maxWidth = 1920, int $maxHeight = 1080, int $quality = 80): bool
    {
        $fullPath = Storage::disk($disk)->path($path);

        if (!file_exists($fullPath)) {
            return false;
        }

        try {
            // Detect image type
            $info = getimagesize($fullPath);
            if (!$info) {
                return false;
            }

            $mime = $info['mime'];
            $srcW = $info[0];
            $srcH = $info[1];

            // Load source image
            $srcImage = match ($mime) {
                'image/jpeg' => imagecreatefromjpeg($fullPath),
                'image/png' => imagecreatefrompng($fullPath),
                'image/gif' => imagecreatefromgif($fullPath),
                'image/webp' => imagecreatefromwebp($fullPath),
                default => null,
            };

            if (!$srcImage) {
                return false;
            }

            // Calculate new dimensions (max Full HD, maintain aspect ratio)
            $newW = $srcW;
            $newH = $srcH;

            if ($srcW > $maxWidth || $srcH > $maxHeight) {
                $ratio = min($maxWidth / $srcW, $maxHeight / $srcH);
                $newW = (int) round($srcW * $ratio);
                $newH = (int) round($srcH * $ratio);
            }

            // Create resized image
            $dstImage = imagecreatetruecolor($newW, $newH);

            // Preserve transparency for PNG/GIF
            if ($mime === 'image/png' || $mime === 'image/gif') {
                imagealphablending($dstImage, false);
                imagesavealpha($dstImage, true);
            }

            imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newW, $newH, $srcW, $srcH);

            // Save as WebP
            $webpPath = preg_replace('/\.[a-zA-Z]+$/', '.webp', $fullPath);
            imagewebp($dstImage, $webpPath, $quality);

            // Cleanup
            imagedestroy($srcImage);
            imagedestroy($dstImage);

            // Remove original if different extension
            $originalExt = pathinfo($fullPath, PATHINFO_EXTENSION);
            if (strtolower($originalExt) !== 'webp') {
                unlink($fullPath);
            }

            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Get the WebP path for a given original path.
     */
    public static function webpPath(string $path): string
    {
        return preg_replace('/\.[a-zA-Z]+$/', '.webp', $path);
    }
}
