<?php 
use App\Models\siteSettings;
use App\Models\User;
    if(!function_exists('getSiteSetting')) {
        function getSiteSetting() {
            $getSiteSetting = siteSettings::first();
            return $getSiteSetting;
        }
    }
    
?>