<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;
use Image;

class SiteSettingController extends Controller
{
    public function SeoSetting(){
        $seo = Seo::find(1);
        return view('backend.seo.seo_update',compact('seo'));

    } // end method

    public function SeoSettingUpdate(Request $request){
        $seo_id = $request->id;
        Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);

        $notification = array(
            'message' => 'SEO Settings updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method
}
