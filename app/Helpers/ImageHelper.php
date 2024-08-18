<?php

namespace App\Helpers;

use Intervention\Image\Laravel\Facades\Image;

class ImageHelper
{
    /**
     * Delete the old image if it exists.
     *
     * @param string $imageName
     * @return void
     */
    public static function deleteOldImage($path, $imageName)
    {
        if ($imageName) {
            $oldImagePath = public_path('images/' . $path . $imageName);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    }

    /**
     * Store the uploaded image and return the new image name.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $destination
     * @return string
     */
    public static function storeImage($image, $destination, $ext = null)
    {
        $imageName = $destination . '/' . $ext . time() . '.' . $image->extension();
        $imagePath = public_path($imageName);

        // Resize and optimize the image
        $img = Image::read($image->getRealPath());

        $img->scaleDown(width: 750, height: 750);

        // Save the resized image with quality adjustment to fit size constraints
        $img->save($imagePath, 75);

        // Ensure the image is between 50KB and 100KB
        while (filesize($imagePath) > 100 * 1024) {
            $img->save($imagePath, $img->quality - 5);
        }

        return $imageName;
    }
}
