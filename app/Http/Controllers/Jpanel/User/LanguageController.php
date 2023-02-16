<?php

namespace App\Http\Controllers\Jpanel\User;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //
    public function index(){
        $languages=Language::all();
        $hasPermission = hasAnyOnePermission('language');
        if($hasPermission)
            return view('jpanel.user.language',['languages'=>$languages]);
        else
            abort(403);
    }

    public function addLanguage(Request $request){
        $request->validate([
            'rname' => 'required|unique:languages,name',
            'slug' => 'required|unique:languages,slug',
        ]);
        $role=new Language;
        $role->name=$request->rname;
        $role->slug=$request->slug;
        $role->save();
        if ($role) {
            return redirect('jpanel/language')->with('success', 'Language has been created successfully!');
        } else {
            return redirect('jpanel/language')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function editLanguage($id){
        $language = Language::find($id);
        $languages=Language::all();
        $hasPermission = hasPermission('language',3);
        if($hasPermission)
            return view('jpanel.user.editLanguage',['language'=>$language,'languages'=>$languages]);
        else
            abort(403);
    }

    public function updateLanguage (Request $request,$lang_id){
        $request->validate([
            'rname' => 'required|unique:languages,name,'.$lang_id,
            'slug' => 'required|unique:languages,slug,'.$lang_id,
        ]);
        $user = Language::where('id', $lang_id)->update(['name' => $request->rname, 'slug' => $request->slug]);
        if ($user) {
            return redirect('jpanel/language')->with('success', 'Language has been updated!');
        } else {
            return redirect('jpanel/language')->with('error', 'Something went wrong. Try again.');
        }
    }

    public function languageDelete(Request $request)
    {
        Language::find($request->lang_id)->delete();
        return response()->json(['status'=>'success','message' => 'Language has been Deleted successfully!']);
    }

    //-----------------------API------------------
    public function languageList(){
        $language = Language::all();
        return response()->json(['data' => $language, 'message' => 'All Language fetched.', 'status' => '200']);
    }

}
