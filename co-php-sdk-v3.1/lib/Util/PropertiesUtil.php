<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/4/17
 * Time: 2:26 PM
 */

namespace Com\Alacriti\Checkout\Client\Util;
use \Com\Alacriti\Checkout\Client\ApiException;
use \Com\Alacriti\Checkout\Client\Checkout;


class PropertiesUtil
{
    const CHECKOUT_API_SERVICE_URL = 'CHECKOUT_API_SERVICE_URL';
    const CHECKOUT_TLS_CERTIFICATE_LOCATION = 'CHECKOUT_TLS_CERTIFICATE_LOCATION';
    const CHECKOUT_PUBLIC_KEY_LOCATION = 'CHECKOUT_PUBLIC_KEY_LOCATION';
    const CLIENT_PRIVATE_KEY_LOCATION = 'CLIENT_PRIVATE_KEY_LOCATION';
    const CLIENT_PRIVATE_KEY_PASSWORD = 'CLIENT_PRIVATE_KEY_PASSWORD';

    static $properties = '';

    public static function  getProperty($property){

         if(self::$properties == null){

            throw new ApiException('Properties are missing.');
        }
        return self::$properties[$property];
    }

}

$propertiesFile = null;

try{
    global $propertiesFile;
    $propertiesFilePath = Checkout::getPropertiesFilePath();

    if($propertiesFilePath == false){
	   echo "<script>console.log('properties file path not set..getting from env variable.');</script>";
        $propertiesFilePath = getenv('orbipay_checkout_config');
    }

    if($propertiesFilePath == false){
	   echo "<script>console.log('properties file path and env variable orbipay_checkout_config is missing');</script>";
        throw new ApiException('properties file path and env variable orbipay_checkout_config is missing');
    }

    $propertiesFile = fopen($propertiesFilePath,'r');
    $str = fread($propertiesFile, filesize($propertiesFilePath));

    $json = json_decode($str,true);
    //print_r('this is json');
   // print_r($json);
    PropertiesUtil::$properties = $json;

}catch (\Exception $e){
    error_log($e);
    throw new ApiException('Unable to read properties file.');
}finally{
    if($propertiesFile !== null){
        fclose($propertiesFile);
    }
}
