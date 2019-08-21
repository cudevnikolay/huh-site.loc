<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;

/**
 * Class ImageSizeHelper
 * @package App\Helpers
 *
 * Returns true or false ifthe width and height
 * of the uploaded image is greater than
 * the maximum possible
 */
class ImageSizeHelper
{
    static public function compareSize( $image):bool
    {
        $realWidth = Image::make($image)->width();
        $realHeight = Image::make($image)->height();

        $configWidth = config('imagesize.team.width');
        $configHeight = config('imagesize.team.height');

        if ($realWidth < $configWidth AND $realHeight < $configHeight) {
            return true;
        } else {
            return false;
        }
    }
}