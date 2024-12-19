<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Utility
{
    public static function addCreated($paraObj)
    {
        $created_at = now();
        $paraObj->created_at = $created_at;
        $paraObj->updated_at = $created_at;
        if (Auth::guard('Admin')->check()) {
            $created_by = Auth::guard('Admin')->user()->id;
            $paraObj->created_by = $created_by;
            $paraObj->updated_by = $created_by;
        }
        return $paraObj;
    }

    public static function addUpdated($paraObj)
    {
        $paraObj->updated_at = now();
        if (Auth::guard('Admin')->check()) {
            $paraObj->updated_by = Auth::guard('Admin')->user()->id;
        }
        return $paraObj;
    }

    public static function addDeleted($paraObj)
    {
        $paraObj->deleted_at = now();
        if (Auth::guard('Admin')->check()) {
            $paraObj->deleted_by = Auth::guard('Admin')->user()->id;
        }
        return $paraObj;
    }

    public static function saveLog($logMessage)
    {
        $querylog = DB::getQueryLog();
        $formattedQuaries = '';
        foreach ($querylog as $query) {
            $sqlQuery = $query['query'];
            foreach ($query['bindings'] as $binding) {
                $sqlQuery = preg_replace('/\?/', "'". $binding . "'", $sqlQuery, 1);
            }
            $formattedQuaries .= $sqlQuery . PHP_EOL;
        }
        log::debug($logMessage . PHP_EOL . $formattedQuaries);
    }

    public static function saveErrorLog($logMessage)
    {
        $querylog = DB::getQueryLog();
        $formattedQuaries = '';
        foreach ($querylog as $query) {
            $sqlQuery = $query['query'];
            foreach ($query['bindings'] as $binding) {
                $sqlQuery = preg_replace('/\?/', "'". $binding . "'", $sqlQuery, 1);
            }
            $formattedQuaries .= $sqlQuery . PHP_EOL;
        }
        log::error($logMessage . PHP_EOL . $formattedQuaries);
    }

    public static function getPublicHolidays($year, $getname = false)
    {
        $public_holidays = [];
        $url = "https://calendarific.com/api/v2/holidays?api_key=1KKtDfmUPrIa1m0ztzYCm2FJQVmSJmgB&country=MM&year=". $year;
        $options = [
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ];
        $response = file_get_contents($url, false, stream_context_create($options));
        $data = json_decode($response, true);
        if (isset($data['response']['holidays'])) {
            $holidays = $data['response']['holidays'];
            foreach ($holidays as $holiday) {
                $holiday_date = [
                    'date' => $holiday['date']['iso'],
                    'name' => $holiday['name']
                ];
                if (strlen($holiday_date['date']) == 10) {
                    $public_holidays[] = $holiday_date;
                }
            }
        } else {
            $public_holidays = [];
        }
        return $public_holidays;
    }
}
