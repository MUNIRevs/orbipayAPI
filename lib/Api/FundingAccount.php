<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/5/17
 * Time: 1:48 PM
 */

namespace Com\Alacriti\Checkout\Client\Api;


use Com\Alacriti\Checkout\Client\ApiClient;
use Com\Alacriti\Checkout\Client\Model\ConfirmAddFundAcctRequest;
use Com\Alacriti\Checkout\Client\Model\FundingAccountToken;
use Com\Alacriti\Checkout\Client\Model\Error;
use Com\Alacriti\Checkout\Client\Model\ConfirmAddFundAcctResponse;
use Com\Alacriti\Checkout\Client\Util\EncryptionUtil;
use Com\Alacriti\Checkout\Client\ApiException;

class FundingAccount extends BaseRequest
{
    private $fundingAccountToken;
    private $digiSign;
    private $customFields;
    private $idAccount;

    function __construct($idAccount = null)
    {
        $this->idAccount = $idAccount;
    }
    /**
     * @return mixed
     */
    public function getFundingAccountToken()
    {
        return $this->fundingAccountToken;
    }

    /**
     * @param mixed $fundingAccountToken
     */
    public function setFundingAccountToken($fundingAccountToken)
    {
        $this->fundingAccountToken = $fundingAccountToken;
    }

    /**
     * @return mixed
     */
    public function getDigiSign()
    {
        return $this->digiSign;
    }

    /**
     * @param mixed $digiSign
     */
    public function setDigiSign($digiSign)
    {
        $this->digiSign = $digiSign;
    }

    /**
     * @return mixed
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * @param mixed $customFields
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;
    }

    public function withCustomFields($customFields){
        $this->customFields = $customFields;
        return $this;
    }

    public function withToken($fundingAccountToken, $digiSign){
        if(gettype($fundingAccountToken) === 'string'){
            $new_fundingAccountToken = new FundingAccountToken();
            $new_fundingAccountToken->setToken($fundingAccountToken);
            $this->fundingAccountToken = $new_fundingAccountToken;
        }else if(gettype($fundingAccountToken) === 'object'){
            $this->fundingAccountToken = $fundingAccountToken;
        }

        $this->digiSign= $digiSign;
        return $this;
    }

    public function forClient($clientId, $signatureKey){
        $this->setClientId($clientId);
        $this->setSignatureKey($signatureKey);
        return $this;
    }

    public function forPartner($clientId, $signatureKey){
        $this->setClientId($clientId);
        $this->setSignatureKey($signatureKey);
        return $this;
    }

    public function add(){
        if ($this->isNullOrEmptyString($this->getClientId())){
            throw new ApiException('Missing required parameter "client_id" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->getSignatureKey())){
            throw new ApiException('Missing required parameter "signature_key" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->fundingAccountToken)){
            throw new ApiException('Missing required parameter "token" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->digiSign)){
            throw new ApiException('Missing required parameter "digi_sign" when calling confirmAddFundingAccount');
        }

        try{
           debug_to_console("in Add() function"); 
	   $decryptedToken = EncryptionUtil::decrypt($this->fundingAccountToken->getToken());
            EncryptionUtil::verify($decryptedToken,$this->digiSign);

            $confirmAddFundingAccountRequest = new ConfirmAddFundAcctRequest();
            $confirmAddFundingAccountRequest->setCustomFields($this->customFields);

            $fundingAccountToken = new FundingAccountToken();
            $fundingAccountToken->setToken(EncryptionUtil::encrypt($decryptedToken));
            $this->fundingAccountToken = $fundingAccountToken;
            $confirmAddFundingAccountRequest->setFundingAccountToken($fundingAccountToken);

            $this->digiSign = EncryptionUtil::sign($decryptedToken);

            $apiClient = new ApiClient($this->getClientId(), $this->getSignatureKey());

            $fundingAccountApi =  new FundingAccountApi($apiClient);

            return $fundingAccountApi->confirmAddFundingAccount($this->getClientId(),$this->digiSign,$confirmAddFundingAccountRequest, false, null);
        }catch (\Exception $e){
            //throw new ApiException('unable to confirmAddFundingAccount'.$e);
            echo "<script>console.log('Exception occured: ".$e->getResponseBody()."');</script>";
	    //throw $e;

                try{
                        $errorbody = $e->getResponseBody();
                        $errorjson = json_decode($errorbody);
                        $errorcode = $errorjson->errors[0]->code;
                        $errormessage = $errorjson->errors[0]->message;
                        //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                        $errorfield = $errorjson->errors[0]->field;

                        $account_add = new ConfirmAddFundAcctResponse();
                        $ea = new Error();

                        $ea->setCode($errorcode);
                        $ea->setMessage($errormessage);
                        $ea->setField($errorfield);

                        $account_add->setError($ea);

                        return $account_add;
                }catch (\Exception $er){
                        echo "<script>console.log('Exception occured: ".$er->getMessage()."');</script>";
                        throw $er;

                 }
       } catch (\ApiException $ae){
            //throw new ApiException('unable to confirmAddFundingAccount'.$e);
            echo "<script>console.log('Exception occured: ".$ae->getResponseBody()."');</script>";
            //throw $e;

                try{
                        $errorbody = $ae->getResponseBody();
                        $errorjson = json_decode($errorbody);
                        $errorcode = $errorjson->errors[0]->code;
                        $errormessage = $errorjson->errors[0]->message;
                        //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                        $errorfield = $errorjson->errors[0]->field;

                        $account_add = new ConfirmAddFundAcctResponse();
                        $ea = new Error();

                        $ea->setCode($errorcode);
                        $ea->setMessage($errormessage);
                        $ea->setField($errorfield);

                        $account_add->setError($ea);

                        return $account_add;
                }catch (\ApiException $aer){
                        echo "<script>console.log('Exception occured: ".$aer->getMessage()."');</script>";
                        throw $aer;

                 }
       }

    }

    public function update(){
        if ($this->isNullOrEmptyString($this->getClientId())){
            throw new ApiException('Missing required parameter "client_id" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->getSignatureKey())){
            throw new ApiException('Missing required parameter "signature_key" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->fundingAccountToken)){
            throw new ApiException('Missing required parameter "token" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->digiSign)){
            throw new ApiException('Missing required parameter "digi_sign" when calling confirmAddFundingAccount');
        }

        try{
     		debug_to_console("in Update() function");       
	    $decryptedToken = EncryptionUtil::decrypt($this->fundingAccountToken->getToken());
            EncryptionUtil::verify($decryptedToken,$this->digiSign);

            $confirmAddFundingAccountRequest = new ConfirmAddFundAcctRequest();
            $confirmAddFundingAccountRequest->setCustomFields($this->customFields);

            $fundingAccountToken = new FundingAccountToken();
            $fundingAccountToken->setToken(EncryptionUtil::encrypt($decryptedToken));
            $this->fundingAccountToken = $fundingAccountToken;
            $confirmAddFundingAccountRequest->setFundingAccountToken($fundingAccountToken);

            $this->digiSign = EncryptionUtil::sign($decryptedToken);

            $apiClient = new ApiClient($this->getClientId(), $this->getSignatureKey());

            $fundingAccountApi =  new FundingAccountApi($apiClient);

            echo '<script>console.log("ID chinna Account: "+'.$this->idAccount.')</script>';

            return $fundingAccountApi->confirmAddFundingAccount($this->getClientId(),$this->digiSign,$confirmAddFundingAccountRequest, true, $this->idAccount);
        }catch (\Exception $e){
            echo "<script>console.log('Exception occured: ".$e->getResponseBody()."');</script>";
//        throw $e;

                try{
                        $errorbody = $e->getResponseBody();
                        $errorjson = json_decode($errorbody);
                        $errorcode = $errorjson->errors[0]->code;
                        $errormessage = $errorjson->errors[0]->message;
                        //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                        $errorfield = $errorjson->errors[0]->field;

                        $account_update = new ConfirmAddFundAcctResponse();
                        $ee = new Error();

                        $ee->setCode($errorcode);
                        $ee->setMessage($errormessage);
                        $ee->setField($errorfield);

                        $account_update->setError($ee);

                        return $account_update;
                }catch (\Exception $ex){
                        echo "<script>console.log('Exception occured: ".$ex->getMessage()."');</script>";
                        throw $ex;

                 }
        } catch (\ApiException $ae){
            echo "<script>console.log('Exception occured: ".$ae->getResponseBody()."');</script>";
//        throw $e;

                try{
                        $errorbody = $ae->getResponseBody();
                        $errorjson = json_decode($errorbody);
                        $errorcode = $errorjson->errors[0]->code;
                        $errormessage = $errorjson->errors[0]->message;
                        //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                        $errorfield = $errorjson->errors[0]->field;

                        $account_update = new ConfirmAddFundAcctResponse();
                        $ee = new Error();

                        $ee->setCode($errorcode);
                        $ee->setMessage($errormessage);
                        $ee->setField($errorfield);

                        $account_update->setError($ee);

                        return $account_update;
                }catch (\ApiException $aex){
                        echo "<script>console.log('Exception occured: ".$aex->getMessage()."');</script>";
                        throw $aex;

                 }
        }

    }
}

