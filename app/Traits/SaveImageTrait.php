<?php


namespace App\Traits;
trait SaveImage {


    public function get_img_path($file)
    {
        $extension = $file->getClientOriginalExtension();
        $destinationPath ='images/';
        $Video = $file->getClientOriginalName();
        $path=uniqid().'.'.$extension;
        $file->move($destinationPath,$path);
        return $destinationPath.$path;
        return $path;
    }




}