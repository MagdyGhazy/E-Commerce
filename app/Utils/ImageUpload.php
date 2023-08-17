<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUpload
{
    public static function uploadImage($request,$width=null,$height=null,$path=null){

        $imageNmae = str::uuid().'.'.date('y-m-d').'.'.$request->extension();
        [$widthDefault , $heightDefault] = getimagesize($request);
        $height = $height ?? $heightDefault;
        $width = $width ?? $widthDefault;
        $image = Image::make($request->path());
        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        })->stream();
        storage::disk('public')->put('img/'.$path.$imageNmae,$image);

        return 'public/img/'.$path.$imageNmae;
    }

}
