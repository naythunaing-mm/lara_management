<?php 
use App\Models\siteSettings;
    if(!function_exists('getSiteSetting')) {
        function getSiteSetting() {
            $getSiteSetting = siteSettings::first();
            return $getSiteSetting;
        }
    }
?>