<?php

namespace App\Libraries;
use Exception;
class UploadImagesController
{
    public   function UploadImage($file,$folder)
    {
        try {
            $imageName = time().'.'.$file->extension();
            $file->move(public_path($folder), $imageName);
            return ($imageName);
        }

        catch (\Exception $exception)
        {
            return  false;
        }
    }
}
