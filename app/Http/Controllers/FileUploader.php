<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploader extends Controller
{
    //file uploader
    public function fileUploader($file, $fileName, $location){
        $current_wd = getcwd();
        $name = $fileName.".".$file->getClientOriginalExtension();
        $file->move($current_wd."/".$location, $name);
        return $name;
    }

    public function deleteFile($fileName, $location){
        $file__ = $location.$fileName;
        unlink($file__);
    }
}
