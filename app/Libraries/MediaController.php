<?php

namespace App\Libraries;

class MediaController
{

    public   function UploadImage($request,$folder)
    {
        if (request()->hasFile('image')) {
            $imageName = time().'.'.$request->extension();
            $request->move(public_path($folder), $imageName);
            return $folder.'/'.$imageName;
        }
        else {
            return false;
        }
    }
    public static  function UploadImages($request,$folder)
    {
        if (request()->hasFile('image')) {
            $image=[];
            foreach ($request as $image){
                $imageName = time().rand(1,100).'.'.$image->extension();
                $image->move(public_path($folder), $imageName);
                $images[]=$folder.'/'.$imageName;
            }

            return $image;
        }
        else {
            return false;
        }
    }

    public static  function UpdateImage($request,$folder,$image)
    {
        if (request()->hasFile('image')) {
            @unlink($image);
            $imageName = time().'.'.$request->extension();
            $request->move(public_path($folder), $imageName);
            return $folder.'/'.$imageName;
        }
        else {
            return false;
        }
    }
    public static  function DeleteImage($image)
    {
            @unlink($image);
            return true;

    }
    public static  function DeleteImages($image)
    {
        if (!empty($image))
        foreach ($image as $image){
            @unlink($image->image);

        }
            return true;

    }


}
