<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/5/17
 * Time: 1:47 PM
 */

namespace Com\Alacriti\Checkout\Client\Api;


class BaseRequest
{
    private $clientId;
    private $signatureKey;

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $partnerId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }

    /**
     * @param mixed $signatureKey
     */
    public function setSignatureKey($signatureKey)
    {
        $this->signatureKey = $signatureKey;
    }

    public function isNullOrEmptyString($string){
        return (!isset($string) || trim($string)==='');
    }

}