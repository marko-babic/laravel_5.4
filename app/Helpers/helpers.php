<?php

namespace App\Helpers;

use \Carbon\Carbon;


class MiscFunctions
{
    /*
    * @author Pedro Pinheiro (https://github.com/pedroppinheiro).
    */

    public static function createThumbnail($filepath, $thumbpath, $thumbnail_width, $thumbnail_height)
    {
        list($original_width, $original_height, $original_type) = getimagesize($filepath);

        $new_width = $thumbnail_width;
        $new_height = $thumbnail_height;

        $dest_x = intval(($thumbnail_width - $new_width) / 2);
        $dest_y = intval(($thumbnail_height - $new_height) / 2);

        if ($original_type === 1) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        } else if ($original_type === 2) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        } else if ($original_type === 3) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        } else {
            return false;
        }

        $old_image = $imgcreatefrom($filepath);
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

        imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        $imgt($new_image, $thumbpath);
        return file_exists($thumbpath);
    }

    /*
     *
     */

    public static function checkTime(Carbon $time, $time_limit)
    {
        if (($time_limit - $time->diffInHours()) > 0) {
            return false;
        }

        return true;
    }
}