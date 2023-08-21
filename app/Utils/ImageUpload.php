<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUpload
{
    public static function uploadImage($request,$path=null,$width=null,$height=null){

        $imageNmae = str::uuid().'.'.date('y-m-d').'.'.$request->extension();
        [$widthDefault , $heightDefault] = getimagesize($request);
        $height = $height ?? $heightDefault;
        $width = $width ?? $widthDefault;
        $image = Image::make($request->path());
        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        })->stream();
        storage::disk('image')->put('img/'.$path.$imageNmae,$image);

        return 'img/'.$path.$imageNmae;
    }

}
