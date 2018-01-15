<?php
/**
 * Created by PhpStorm.
 * User: FAKHAR
 * Date: 11/3/2017
 * Time: 12:00 PM
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

if (!function_exists('slug')) {

    function slug() {
        
        return auth()->user()->user_type ? auth()->user()->user_type->slug : '' ;
    }
}

if (!function_exists('parseDate')) {

    function parseDate($input) {

        return  Carbon::parse($input);

    }
}


