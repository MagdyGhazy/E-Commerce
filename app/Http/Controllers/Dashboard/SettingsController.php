<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingUpdateRequest;
use App\Models\Setting;
use App\Utils\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{

    public function index(){
        return view('dashboard.settings.index');
    }

    public function update(SettingUpdateRequest $request,setting $settings){
        $settings->update($request->validated());

        if ($request->has('logo')){
            $logo = ImageUpload::uploadImage($request->logo,'logo/');
            $settings->update(['logo'=>$logo]);
        }
        if ($request->has('favicon')){
            $favicon = ImageUpload::uploadImage($request->favicon,'favicon/',200,200);
            $settings->update(['favicon'=>$favicon]);
        }

        return redirect()->route('settings');
    }
}
