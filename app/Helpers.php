<?php
use Carbon\Carbon;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
//
if (! function_exists('convertLocalToUTC')) {
    function convertLocalToUTC($time)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $time, 'Asia/Kolkata')->setTimezone('UTC');
    }
}

if (! function_exists('convertUTCToLocal')) {
    function convertUTCToLocal($time)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $time, 'UTC')->setTimezone('Asia/Kolkata');
    }
}

if (! function_exists('getModuleId')) {
    function getModuleId($module_slug)
    {
        $modules = Module::select('id')->where('slug', '=', $module_slug)->get()->first();
        $module_id = ((!empty($modules)) ? $modules->id : 0);
        return $module_id;
    }
}

if (! function_exists('hasAnyOnePermission')) {
    function hasAnyOnePermission($module)
    {
        $module_id= getModuleId($module);
        $user_id = Auth::id();
        $permission = Permission::where('user_id', '=', $user_id)->where('module_id', '=', $module_id)->get()->first();
        $myPermission = ((!empty($permission)) ? 1 : 0);
        return $myPermission;
    }
}

if (! function_exists('hasPermission')) {
    function hasPermission($module,$action_id)
    {
        $module_id= getModuleId($module);
        $user_id = Auth::id();
        $permission = Permission::where('user_id', '=', $user_id)->where('module_id', '=', $module_id)->where('action_id', '=', $action_id)->get()->first();
        $myPermission = ((!empty($permission)) ? 1 : 0);
        return $myPermission;
    }
}

if (! function_exists('resizeImage')) {
    function resizeImage($image,$thumbnailPath,$mainImagePath,$imageName,$size_x,$size_h)
    {
        $thumbnailImg = Image::make($image);
        $mainImg = Image::make($image);
        if (!File::exists($thumbnailPath)) {
            File::makeDirectory($thumbnailPath,0755,true,true);
        }
         $thumbnailImg->resize($size_x, $size_h, function($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailImg->save($thumbnailPath.$imageName);
        $mainImg->save($mainImagePath.$imageName);
        return true;
    }
}

if (! function_exists('uploadPDF')) {
    function uploadPDF($fileNa,$filePath,$fileName)
    {
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath,0755,true,true);
        }
        $fileNa->move($filePath,$fileName);
        return true;
    }
}

?>
