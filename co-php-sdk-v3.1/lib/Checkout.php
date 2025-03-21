<?php
/**
 * Created by PhpStorm.
 * User: parvezk
 * Date: 16/3/19
 * Time: 7:27 PM
 */

namespace Com\Alacriti\Checkout\Client;

class Checkout
{
    private static $path = "";

    public static function initProperties($propertiesFilePath){

        echo "<script>console.log('in initProperties:::".$propertiesFilePath."');</script>";
        
        if($propertiesFilePath == null){
	    echo "<script>console.log('Invalid properties file path!');</script>";
            throw new ApiException('Invalid properties file path:'+ $propertiesFilePath);
        }
	
        self::$path = $propertiesFilePath;
    }

    public static function getPropertiesFilePath(){
	   echo "<script>console.log('in getPropertiesFilePath:".self::$path."');</script>";
        return self::$path;
    }

}
