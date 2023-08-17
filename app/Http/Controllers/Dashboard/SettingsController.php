<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index(){
        return view('dashboard.settings.index');
    }

    public function update(SettingUpdateRequest $request,setting $settings){
        $settings->update($request->validated());
        return redirect()->route('settings');
    }
}
