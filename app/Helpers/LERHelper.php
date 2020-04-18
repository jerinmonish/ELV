<?php
/**
 * @package         Helper
 * @Purpose         TO Manage Helper Functions
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
use Image;
use DB;
use URL;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LERHelper
{

    // To encrypt id in url
    public static function encryptUrl($id) {
        if($id){
            $id = base64_encode(($id + 122354125410));
            return $id;
        }
    }

    // To decrypt id in url
    public static function decryptUrl($id) {
        if(is_numeric(base64_decode($id))){
            $id = explode(",", base64_decode($id))[0] - 122354125410;
            return $id;
        } 
        abort(404);
    }

    // To User name
    public static function getFullName($id) {
        if($id){
            $get_name = User::select('name')->where('id', $id)->first();
            return ucfirst(@$get_name['name']);
        } else {
            return false;
        }
    }

    public static function formatSizeUnits($bytes){
        if ($bytes >= 1073741824){
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }elseif ($bytes >= 1048576){
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }elseif ($bytes >= 1024){
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }elseif ($bytes > 1){
            $bytes = $bytes . ' bytes';
        }elseif ($bytes == 1){
            $bytes = $bytes . ' byte';
        }else{
            $bytes = '0 bytes';
        }
        return $bytes;
}


    // To get events name
    public static function getEvents($id) {
        if($id){
            $get_event = Events::select('event_name')->where('id', $id)->first();
            return $get_event['event_name'];
        } else {
            return false;
        }
    }

    // format date to india format
    public static function formatDate($date=false,$format = 'd-m-Y') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            /*$date = new \DateTime();
            return $date->format($format);*/
            return 'Nil';
        }
    }

    // format date to india format
    public static function manuFormatDate($date=false,$format = 'd-m-Y') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

    // format date to india format
    public static function adminViewDate($date=false,$format = 'd-M-Y h:i:s A') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $curDate = date("d-M-Y H:i:s");
            return $curDate;
        }
    }

     // format date to india format
    public static function adminViewDate2($date=false,$format = 'd-M-Y h:i:s') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $curDate = date("d-M-Y H:i:s");
            return $curDate;
        }
    }


    // format date to mysql format
    public static function formatMysqlDate($date,$format = 'Y-m-d') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

    // format date to mysql format
    public static function formatMysqlTime($date,$format = 'H:i') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

    // format date to mysql format
    public static function formatMysqlTimedisplay($date,$format = 'h:i a') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }

     /*
    * return the number with the given limit - particularly for the float numbers
    */
    public static function mysqlDateTime($date=FALSE, $format = 'Y-m-d h:m:s'){
       if($date){
            return date($format, strtotime($date));
       }else{
            return date($format);
       }
    }


    // format date to News Events
    public static function formatNewsEvents($date,$format = 'M d, Y') {
        if($date) {
            $date = new \DateTime($date);
            return $date->format($format);
        }else{
            $date = new \DateTime();
            return $date->format($format);
        }
    }
}
