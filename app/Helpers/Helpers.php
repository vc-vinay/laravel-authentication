<?php

use App\Constant\Constant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

if (!function_exists('includeRouteFiles')) {
    /**
     * Loops through a folder and requires all PHP files
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $ex) {
            Log::error($ex);
        }
    }
}

if (!function_exists('getAuthUser')) {
    /**
     * Get logged in user
     *
     * @return User
     */
    function getAuthUser(): ?User
    {
        try {
            return Auth::user();
        } catch (Exception $ex) {
            Log::error($ex);
        }
    }
}
