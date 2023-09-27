<?php 

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait UploadFile {

    private function uploadImage($image, $path, $old_file = Null) {
        if ($old_file != 'default.png') {
            $this->deleteImage($old_file, $path);
        }
        Image::make($image)
        ->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })
        ->save(public_path($path . '/' . $image->hashName()));
        return $image->hashName();
    }

    private function deleteImage($old_file, $path) {
        if($old_file) {
        if (file_exists(public_path($path . $old_file))) {
            unlink(public_path($path . $old_file));
        }
    }
    }


}