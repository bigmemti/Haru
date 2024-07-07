<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileManager{
    public function upload(UploadedFile $file, $folder = '', $disk = 'public') : string {

        $file_name = time() . $file->getClientOriginalName();
        $file_path   = trim(str_replace(['\\','/'],DIRECTORY_SEPARATOR,$folder), DIRECTORY_SEPARATOR). DIRECTORY_SEPARATOR . $file_name;

        Storage::disk($disk)->put( $file_path, File::get($file));

        return $file_path;
    }

    public function delete($file_path, $disk = 'public')
    {
        Storage::disk($disk)->delete($file_path);
    }

}
