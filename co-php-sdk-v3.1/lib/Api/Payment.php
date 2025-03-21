<?php
/**
 * Created by PhpStorm.
 * User: parvezk
 * Date: 10/4/18
 * Time: 10:35 AM
 */

namespace Com\Alacriti\Checkout\Client\Api;


use Com\Alacriti\Checkout\Client\ApiClient;
use Com\Alacriti\Checkout\Client\Model\ConfirmPaymentTokenRequest;
use Com\Alacriti\Checkout\Client\Model\PaymentToken;
use Com\Alacriti\Checkout\Client\Model\PaymentVO;
use Com\Alacriti\Checkout\Client\Model\Error;
use Com\Alacriti\Checkout\Client\Util\EncryptionUtil;
use Com\Alacriti\Checkout\Client\ApiException;

class Payment extends BaseRequest
{

    private $id;
    private $url;
    private $paymentStatus;
    private $confirmationNumber;
    private $payer;
    private $paymentReference;
    private $currencyCode3d;
    private $amount;
    private $paymentDate;
    private $paymentMethod;
    private $paymentScheduleType;
    private $paymentRequestDate;
    private $paymentAmountType;
    private $returnCode;
    private $fundingAccount;
    private $customerAccount;
    private $expectedPaymentSettlementDate;
    private $paymentEntryDate;
    private $paymentReturnDate;
    private $token;
    private $digiSign;
    private $customerAccountReference;
    private $customFields;
    private $paymentToken;
    private $fee;
    private $feeAmount;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param mixed $paymentStatus
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @return mixed
     */
    public function getConfirmationNumber()
    {
        return $this->confirmationNumber;
    }

    /**
     * @param mixed $confirmationNumber
     */
    public function setConfirmationNumber($confirmationNumber)
    {
        $this->confirmationNumber = $confirmationNumber;
    }

    /**
     * @return mixed
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param mixed $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    /**
     * @return mixed
     */
    public function getPaymentReference()
    {
        return $this->paymentReference;
    }

    /**
     * @param mixed $paymentReference
     */
    public function setPaymentReference($paymentReference)
    {
        $this->paymentReference = $paymentReference;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode3d()
    {
        return $this->currencyCode3d;
    }

    /**
     * @param mixed $currencyCode3d
     */
    public function setCurrencyCode3d($currencyCode3d)
    {
        $this->currencyCode3d = $currencyCode3d;
    }

    /**
     * @param mixed $verificationCode
     */
    public function setVerificationCode($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }


    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * @param mixed $paymentDate
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param mixed $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }


    /**
     * @return mixed
     */
    public function getPaymentScheduleType()
    {
        return $this->paymentScheduleType;
    }

    /**
     * @param mixed $paymentScheduleType
     */
    public function setPaymentScheduleType($paymentScheduleType)
    {
        $this->paymentScheduleType = $paymentScheduleType;
    }

    /**
     * @return mixed
     */
    public function getPaymentRequestDate()
    {
        return $this->paymentRequestDate;
    }

    /**
     * @param mixed $paymentRequestDate
     */
    public function setPaymentRequestDate($paymentRequestDate)
    {
        $this->paymentRequestDate = $paymentRequestDate;
    }

    /**
     * @return mixed
     */
    public function getPaymentAmountType()
    {
        return $this->paymentAmountType;
    }

    /**
     * @param mixed $paymentAmountType
     */
    public function setPaymentAmountType($paymentAmountType)
    {
        $this->paymentAmountType = $paymentAmountType;
    }

    /**
     * @return mixed
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     * @param mixed $returnCode
     */
    public function setReturnCode($returnCode)
    {
        $this->returnCode = $returnCode;
    }

    /**
     * @return mixed
     */
    public function getFundingAccount()
    {
        return $this->fundingAccount;
    }

    /**
     * @param mixed $fundingAccount
     */
    public function setFundingAccount($fundingAccount)
    {
        $this->fundingAccount = $fundingAccount;
    }

    /**
     * @return mixed
     */
    public function getCustomerAccount()
    {
        return $this->customerAccount;
    }

    /**
     * @param mixed $customerAccount
     */
    public function setCustomerAccount($customerAccount)
    {
        $this->customerAccount = $customerAccount;
    }

    /**
     * @return mixed
     */
    public function getExpectedPaymentSettlementDate()
    {
        return $this->expectedPaymentSettlementDate;
    }

    /**
     * @param mixed $expectedPaymentSettlementDate
     */
    public function setExpectedPaymentSettlementDate($expectedPaymentSettlementDate)
    {
        $this->expectedPaymentSettlementDate = $expectedPaymentSettlementDate;
    }

    /**
     * @return mixed
     */
    public function getPaymentEntryDate()
    {
        return $this->paymentEntryDate;
    }

    /**
     * @param mixed $paymentEntryDate
     */
    public function setPaymentEntryDate($paymentEntryDate)
    {
        $this->paymentEntryDate = $paymentEntryDate;
    }

    /**
     * @return mixed
     */
    public function getPaymentReturnDate()
    {
        return $this->paymentReturnDate;
    }

    /**
     * @param mixed $paymentReturnDate
     */
    public function setPaymentReturnDate($paymentReturnDate)
    {
        $this->paymentReturnDate = $paymentReturnDate;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
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
    public function getCustomerAccountReference()
    {
        return $this->customerAccountReference;
    }

    /**
     * @param mixed $customerAccountReference
     */
    public function setCustomerAccountReference($customerAccountReference)
    {
        $this->customerAccountReference = $customerAccountReference;
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

    /**
     * @return mixed
     */
    public function getPaymentToken()
    {
        return $this->paymentToken;
    }

    /**
     * @param mixed $paymentToken
     */
    public function setPaymentToken($paymentToken)
    {
        $this->paymentToken = $paymentToken;
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param mixed $fee
     */
    public function setFee($fee)
    {
        $this->fee = $fee;
    }

    /**
     * @return mixed
     */
    public function getFeeAmount()
    {
        return $this->feeAmount;
    }

    /**
     * @param mixed $feeAmount
     */
    public function setFeeAmount($feeAmount)
    {
        $this->feeAmount = $feeAmount;
    }



    function __construct($customerAccountReference, $amount)
    {
        $this->customerAccountReference = $customerAccountReference;
        $this->amount= $amount;
    }

    public function withCustomFields($customFields){
        $this->customFields = $customFields;

        if(sizeof($customFields) == 0) {
            echo "<script>console.log('No custom fields passed');</script>";
            $this->customFields = array_map();
        }
        return $this;
    }

    public function withToken($paymentToken, $digiSign){
        if(gettype($paymentToken) === 'string'){
            $this->token = $paymentToken;
            $this->paymentToken = new PaymentToken($this->getToken(), $this->getAmount());
        }else{
            $this->paymentToken = $paymentToken;
        }
        $this->digiSign = $digiSign;
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

    public function withFee($feeAmount){
	$this->setFeeAmount($feeAmount);
	return $this;	
    }

    public function confirm(){
	echo "<script>console.log('in confirm()');</script>";
        if ($this->isNullOrEmptyString($this->getClientId())){
            throw new ApiException('Missing required parameter "client_id" when calling ConfirmPaymentToken');
        }

        if ($this->isNullOrEmptyString($this->getSignatureKey())){
            throw new ApiException('Missing required parameter "signature_key" when calling ConfirmPaymentToken');
        }

        if ($this->isNullOrEmptyString($this->paymentToken->getToken())){
            throw new ApiException('Missing required parameter "token" when calling ConfirmPaymentToken');
        }

        if ($this->isNullOrEmptyString($this->digiSign)){
            throw new ApiException('Missing required parameter "digi_sign" when calling ConfirmPaymentToken');
        }
        if ($this->isNullOrEmptyString($this->paymentToken->getTokenizedAmount())){
            throw new ApiException('Missing required parameter "amount" when calling ConfirmPaymentToken');
        }
        if ($this->isNullOrEmptyString($this->getfeeAmount())){
            throw new ApiException('Missing required parameter "fee" when calling ConfirmPaymentToken');
        }

        try{
            $decryptedToken = EncryptionUtil::decrypt($this->paymentToken->getToken());
            EncryptionUtil::verify($decryptedToken,$this->digiSign);

            $confirmPaymentTokenRequest = new ConfirmPaymentTokenRequest();
            $confirmPaymentTokenRequest->setCustomerAccountReference($this->customerAccountReference);
            $confirmPaymentTokenRequest->setCustomFields($this->customFields);

            $tokenizedAmount = round($this->paymentToken->getTokenizedAmount(), 2);
            echo "<script>console.log('Rounded amount: ".$tokenizedAmount."');</script>";
            $paymentToken = new PaymentToken(EncryptionUtil::encrypt($decryptedToken), EncryptionUtil::encrypt($tokenizedAmount));
            //$paymentToken->setToken(EncryptionUtil::encrypt($decryptedToken));
            //$paymentToken->setTokenizedAmount(EncryptionUtil::encrypt($tokenizedAmount));
            $confirmPaymentTokenRequest->setPaymentToken($paymentToken);
	    $confirmPaymentTokenRequest->setFeeAmount($this->getFeeAmount());
	    $feeAmount = $confirmPaymentTokenRequest->getFeeAmount();
	    echo "<script>console.log('Fee amount::: ".$feeAmount."');</script>";
	    $this->digiSign = EncryptionUtil::sign($decryptedToken);
            $apiClient = new ApiClient($this->getClientId(), $this->getSignatureKey());
            echo "<script>console.log('initialized apiclient');</script>";
            $paymentTokenAPI =  new PaymentTokenApi($apiClient);	
            return $paymentTokenAPI->confirmPaymentToken($this->getClientId(), $this->digiSign, $confirmPaymentTokenRequest);
	
        }catch (\Exception $e){
          echo "<script>console.log('Exception occured: ".$e->getResponseBody()."');</script>";   
//	  throw $e;
		
		try{
               		$errorbody = $e->getResponseBody();
			$errorjson = json_decode($errorbody);
			$errorcode = $errorjson->errors[0]->code;
			$errormessage = $errorjson->errors[0]->message;
			//echo "<script>console.log('Error message is: ".$errormessage."');</script>";
			$errorfield = $errorjson->errors[0]->field;
               	 	
			$payment = new PaymentVO();
			$ee = new Error();

			$ee->setCode($errorcode);
               	 	$ee->setMessage($errormessage);
			$ee->setField($errorfield);

			$payment->setError($ee);              
                
                	return $payment;
         	}catch (\Exception $ex){
           		echo "<script>console.log('Exception occured: ".$ex->getMessage()."');</script>";   
           		throw $ex;
       
       		 }  
        }catch (ApiException $ae){
          echo "<script>console.log('Exception occured: ".$ae->getResponseBody()."');</script>";
//        throw $e;

                try{
                        $errorbody = $ae->getResponseBody();
                        $errorjson = json_decode($errorbody);
                        $errorcode = $errorjson->errors[0]->code;
                        $errormessage = $errorjson->errors[0]->message;
                        //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                        $errorfield = $errorjson->errors[0]->field;

                        $payment = new PaymentVO();
                        $ee = new Error();

                        $ee->setCode($errorcode);
                        $ee->setMessage($errormessage);
                        $ee->setField($errorfield);

                        $payment->setError($ee);

                        return $payment;
                }catch (ApiException $aex){
                        echo "<script>console.log('Exception occured: ".$aex->getMessage()."');</script>";
                        throw $aex;

                 }
        }

    }
}
