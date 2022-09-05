<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('upload');
        $base = pathinfo( $file->getClientOriginalName() , PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $file_name = $base . "_" . now() . "." . $ext ;
        $upload = $file->storeAs("image/product" , $file_name , 'public_html');
        $function = $request->CKEditorFuncNum ;
        $upload_url = asset($upload);
        $message = 'تصویر به درستی آپلود شد' ;
        return response("<script>window.parent.CKEDITOR.tools.callFunction('{$function}' , '{$upload_url}' ,'{$message}') </script>");
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
