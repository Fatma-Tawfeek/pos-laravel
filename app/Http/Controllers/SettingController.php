<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{

    use UploadFile;
    public function edit()
    {
        return view('settings.edit', [
            'settings' => Setting::get(['key', 'value'])
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            
            if($request->hasFile($key)) {
               $image = $this->uploadImage($value, Setting::IMAGE_PATH, app('settings')[$key] );
               Setting::where('key', $key)->update(['value' => $image]);
            }else {
            Setting::where('key', $key)->update(['value' => $value]);
            }
        }

        Cache::forget('settings');

        Alert::toast(trans('users.success_msg'), 'success');

        return back();

    }
}
