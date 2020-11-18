<?php
use App\Setting;
use Illuminate\Support\Facades\File;

/***********************************************************************************/
// set settings
// if (!function_exists('setSettingsInCookie')) {
//     function setSettingsInCookie() {
//         // $settings = Setting::getSettings();
//         // if ($settings != null) {
//         //    setcookie('settings', json_encode($settings), time() + 3600, '/');
//         // }
//     }
// }

// get settings
if (!function_exists('getSettings')) {
    function getSettings($key = null) {
        return App\Setting::getSettings($key);
    }
}
/***********************************************************************************/

// get responseHandel
if (!function_exists('resHandel')) {
    function resHandel($data = [], $message = 'Success', $code = 200, $headers = []) {
        return response(['data' => $data, 'message' => $message, 'code' => $code], $code, $headers);
    }
}
/***********************************************************************************/

// delete any image
if (!function_exists('deleteImage')) {
    function deleteImage($path) {
        if (file_exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }
}
/***********************************************************************************/

// delete any image from model in db
if (!function_exists('deleteImageModel')) {
    function deleteImageModel($model, $propertyName, $defaultImage = null) {
        $model = is_array($model) ? $model : $model->toArray();
        if ($defaultImage !== null) {
            if ($model[$propertyName] != $defaultImage && $model[$propertyName] !== null) {
                return deleteImage(public_path($model[$propertyName]));
            }
        } else {
            if ($model[$propertyName] !== null) {
                return deleteImage(public_path($model[$propertyName]));
            }
        }
        return false;
    }
}
/***********************************************************************************/

if (!function_exists('uploadFileBase64')) {
    function uploadFileBase64($path, $file) {
        $base64_str = substr($file, strpos($file, ",") + 1);
        $fileUpload = base64_decode($base64_str);
        File::put($path, $fileUpload);
        return true;
    }
}


/***********************************************************************************/
if (!function_exists('convert_str_to_array')) {
    function convert_str_to_array($arr, $column) {
        $column_str = $arr[$column];
        $column_arr = [];
        if ($column_str != null && trim($column_str) != '') {
            $column_str = explode(',', $column_str);
            $i = 1;
            foreach ($column_str as $columnValue) {
                $column_arr[] = ['id' => $i, 'value' => $columnValue];
                $i++;
            }
        }
        $arr[$column] = $column_arr;
        return $arr;
    }
}

/***********************************************************************************/
// convert features from string to array
if (!function_exists('convert_column_to_array')) {
    function convert_column_to_array($items_arr, $column) {
        $items_arr = is_array($items_arr) ?  $items_arr : $items_arr->toArray();
        $items_result = [];
        if (array_key_exists(0, $items_arr)) {
            foreach ($items_arr as $item) {
                $items_result[] = convert_str_to_array($item, $column);
            }
        } else {
            $items_result = convert_str_to_array($items_arr, $column);
        }
        return collect($items_result);
    }
}

/***********************************************************************************/
if (!function_exists('paginate_collection')) {
    function paginate_collection($items_paginate, $data)
    {
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $data,
            $items_paginate->total(),
            $items_paginate->perPage(),
            $items_paginate->currentPage(), [
                'path' => \Request::url(),
                'query' => [
                    'page' => $items_paginate->currentPage()
                ]
            ]
        );
    }
}

/***********************************************************************************/
// add Prefix in url admin [control panel]
if (!function_exists('aurl')) {
    function aurl($url = null) {
        $name = env('CP_PREFIX');
        if ($url !== null) {
            return url($name . '/' . $url);
        }
        return '';
    }
}
/***********************************************************************************/


/***********************************************************************************/
// add class active in links active
if (!function_exists('active_link')) {
    function active_link($uri, $recursive = true, $indexSegment = 1, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === Request::segment($indexSegment)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (url($uri) === Request::url()) {
                return $class_name;
            }
        }
        return '';
    }
}
/***********************************************************************************/
if (!function_exists('active_link_url')) {
    function active_link_url($url, $class_name = 'active') {
        if ($url === Request::url()) {
            return $class_name;
        }
        return '';
    }
}
/***********************************************************************************/


/***********************************************************************************/
// add class active in links active
if (!function_exists('active_link_cp')) {
    function active_link_cp($uri, $recursive = true, $indexSegment = 2, $class_name = 'active') {
        if ($recursive === true) {
            if ($uri === Request::segment($indexSegment)) {
                return $class_name;
            }
        } else if ($recursive === false) {
            if (aurl($uri) === Request::url()) {
                return $class_name;
            }
        }
        return '';
    }
}
/***********************************************************************************/


/***********************************************************************************/
if (!function_exists('lang')) {
    function lang() {
        $name_cookies = env('LARAVEL_COOKIES_LANG_NAME', 'laravel_cookies_lang');
        $defaultLang = Cookie::get($name_cookies) !== null ? Cookie::get($name_cookies) : 'en';
        if (env('USER_LANG_ALLOW') === true) {
            if (auth()->check()) {
                session()->put($name_cookies, auth()->user()->lang);
            }
        }
        if (session()->has($name_cookies)) {
            $currentLang = session($name_cookies);
        } else {
            session()->put($name_cookies, $defaultLang);
            $currentLang = $defaultLang;
        }
        setcookie($name_cookies, $currentLang, time() + (60 * 24 * 30 * 12), '/'); // expired after 1 year.
        return $currentLang;
    }
}
if (!function_exists('get_lang')) {
    function get_lang() {
        return lang();
    }
}
if (!function_exists('default_lang')) {
    function default_lang() {
        return lang();
    }
}
/***********************************************************************************/
// Ge Direction
if (!function_exists('direction')) {
    function direction() {
        $name_cookies = env('LARAVEL_COOKIES_LANG_NAME', 'laravel_cookies_lang');
        if (session()->has($name_cookies)) {
            if (session($name_cookies) == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'ltr';
        }
    }
}
if (!function_exists('dir')) {
    function dir() {
        return direction();
    }
}
if (!function_exists('get_dir')) {
    function get_dir() {
        return direction();
    }
}
if (!function_exists('get_dir_css')) {
    function get_dir_css() {
        return direction() == 'rtl' ? 'right' : 'left';
    }
}
/***********************************************************************************/
