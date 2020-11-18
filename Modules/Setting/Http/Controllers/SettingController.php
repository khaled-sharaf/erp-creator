<?php

namespace Modules\Setting\Http\Controllers;

use Modules\Setting\Entities\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;
use File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class SettingController extends Controller
{

    private $directory = 'images/settings';

    public function index(Request $request)
    {
        $sortBy = $request->sortBy;
        $length = $request->length;
        $dir = $request->dir;
        $draw = $request->draw;
        $searchValue = $request->search;
        $query = Setting::select('*')->orderBy($sortBy, $dir)->with('user');

        $query->where('name', '!=', 'data_tabel_settings_view_columns');

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('slug', 'like', '%' . $searchValue . '%');
            });
        }
        $settings = $query->paginate($length);
        return response(['data' => $settings, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(Request $request)
    {
        $this->validate(request(), [
            'slug' => 'required|string|max:191',
            'name' => 'required|string|alpha_dash|max:191|unique:settings',
            'value' => 'nullable|string',
            'type' => 'required|in:image,string,text',
        ]);
        $request->merge(['user_id' => auth()->id()]);
        $directory = $this->directory;
        // if (strpos($request->value, 'data:image/') === 0) {
        //     $get_ext = explode(';', explode('/', $request->value)[1])[0];
        //     $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
        //     $imageNewName = uniqid('setting-image-') . '-' . Str::kebab(strtolower($request->name)) . '.' . $ext;
        //     $imagePath = $directory . '/' . $imageNewName;
        //     if (!is_dir(public_path($directory))) {
        //         File::makeDirectory(public_path($directory), 0777, true);
        //     }
        //     Image::make($request->value)->save(public_path($imagePath));
        //     $request->merge(['value' => $imagePath]);
        // }
        Setting::create($request->all());
        return response(['message' => 'Setting has been created.']);
    }


    public function show($id)
    {
        $setting = Setting::find($id);
        return response(['setting' => $setting]);
    }


    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        $this->validate(request(), [
            'slug' => 'required|string|max:191',
            'value' => 'nullable|string',
            'name' => [
                'required',
                Rule::exists('settings')->where(function ($query) use ($id) {
                    $query->where('id', $id);
                })
            ],
            'type' => [
                'required',
                Rule::exists('settings')->where(function ($query) use ($id) {
                    $query->where('id', $id);
                })
            ]
        ]);

        // delete old image if exists
        if ($setting->value !== null && $setting->value !== '' && $setting->type == 'image' && $request->value != $setting->value) {
            if (file_exists(public_path($setting->value))) {
                unlink(public_path($setting->value));
            }
        }

        // if (strpos($request->value, 'data:image/') === 0) {
        //     $get_ext = explode(';', explode('/', $request->value)[1])[0];
        //     $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
        //     $imageNewName = uniqid('setting-image-') . '-' . Str::kebab(strtolower($request->name)) . '.' . $ext;
        //     $imagePath = $this->directory . '/' . $imageNewName;
        //     Image::make($request->value)->save(public_path($imagePath));
        //     $request->merge(['value' => $imagePath]);
        // }

        $setting->update($request->all());
        return response(['message' => 'Setting has been updated.']);
    }


    public function destroy($id)
    {
        $setting = Setting::find($id);
        if (strpos($setting->value, $this->directory . '/') === 0) {
            if (file_exists(public_path($setting->value))) {
                unlink(public_path($setting->value));
            }
        }
        $setting->delete();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $settings = Setting::whereIn('id', $ids)->get();
        foreach ($settings as $setting) {
            if (strpos($setting->value, $this->directory . '/') === 0) {
                if (file_exists(public_path($setting->value))) {
                    unlink(public_path($setting->value));
                }
            }
        }
        Setting::destroy($ids);
        return response(['status' => true]);
    }


    public function getByName($name)
    {
        $setting = Setting::where('name', $name)->first()->value;
        return response(['setting' => $setting]);
    }


    public function save(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'value' => 'required|string',
        ]);
        Setting::where('name', $request->name)->update($request->all());
        return response(['status' => true]);
    }

}
