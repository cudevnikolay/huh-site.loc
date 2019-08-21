<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;

/**
 * Class ImageHelper
 * @package App\Helpers
 *
 */
class ImageHelper
{
    /**
     * Create image file by name
     *
     * @param $imagePath
     * @param $image
     */
    public static function createImage($image, $imagePath, $resize = [])
    {
        $imageRootPath = public_path($imagePath);

        // create image object
        $imageCreater = Image::make($image);
        if ($resize) {
            list($width, $height) = $resize;
            $imageCreater->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $imageCreater->save($imageRootPath);

        // set permission
        self::setPermissions($imageRootPath);
    }

    /** Set permission to file by path
     *
     * @param string $path
     * @param int $permissions
     */
    private static function setPermissions($path, $permissions = 0755)
    {
        chmod($path, $permissions);
    }

    /**
     * Deleting a local picture from the directory when updating
     *
     * @param   string $iconPath Image local path
     *
     * return void
     */
    public static function deleteLocalImage(string $iconPath)
    {
        if (file_exists(public_path($iconPath))) {
            unlink(public_path($iconPath));
        }
    }

    /**
     * @param string $imagePath image path on the server
     * @param string $type type of the path (config/filepath)
     *
     * @return string
     */
    public static function getUrl($imagePath, $type):string
    {
        if ($imagePath && $type) {
            $filepath = config('filepath.image.' . $type);
            if ($filepath) {
                return config('app.front_url') . $filepath . DIRECTORY_SEPARATOR . $imagePath;
            }
        }

        return '';
    }
}