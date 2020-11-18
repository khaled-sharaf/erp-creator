<?php

namespace App\Http\Controllers\Admin\ProjectManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ProjectManagement\PlatformRequest;
use App\Models\ProjectManagement\Platform;

class PlatformController extends Controller
{

    public function index()
    {
        return response([
            'platforms' => Platform::get()
        ]);
    }


    public function update(PlatformRequest $request)
    {
        $platforms = $request->platforms;
        $deletedPlatforms = $request->deletedPlatforms;

        // delete job titles has deleted
        if (count($deletedPlatforms) > 0) {
            $allPlatforms = Platform::whereIn('id', $deletedPlatforms)->get();
            foreach ($allPlatforms as $platform) {
                deleteImageModel($platform, 'logo');
                $platform->delete();
            }
        }
        /***************************************************/
        for ($x = 0; $x < count($platforms); $x++) {
            $oldPlatform = key_exists('id', $platforms[$x]) ? Platform::find($platforms[$x]['id']) : null;
            $platforms[$x]['logo'] = Platform::saveImage($platforms[$x]['logo'], $oldPlatform);
            Platform::updateOrCreate(
                [
                    'id' => key_exists('id', $platforms[$x]) ? $platforms[$x]['id'] : 0
                ],
                $platforms[$x]
            );
        }
        /***************************************************/
        return response(['message' => 'The platforms has been updated.']);
    }
}
