<?php


namespace App\Helpers;
use Request;
use App\Models\ActivityLog as ActivityLogModel;

class Helpers
{
    public static function addToLog($logName,$logDetails)
    {
        $log = [];
        $log['log_name'] = $logName;
        $log['log_details'] = $logDetails;
        $log['url'] = Request::fullUrl();
        $log['íp'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['created_by'] = Auth()->check() ? auth()->user()->userid : 1;

        ActivityLogModel::create($log);
    }

    public static function is_current_route($path,$route){
        $current_menu_level = explode('/',$path);
        return '/'.$current_menu_level[0] == $route ? 'class=active':'';
    }


}