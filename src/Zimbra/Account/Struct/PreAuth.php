<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Base;

/**
 * PreAuth struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PreAuth extends Base
{
    /**
     * Constructor method for PreAuth
     * @param  int    $timestamp
     *   Time stamp
     * @param  string $value
     *   Computed preauth value
     * @param  int    $expiresTimestamp
     *    Expiration time of the authtoken, in milliseconds.
     *    Set to 0 to use the default expiration time for the account.
     *    Can be used to sync the auth token expiration time with the external system's notion of expiration (like a Kerberos TGT lifetime, for example).
     * @return self
     */
    public function __construct($timestamp, $value = null, $expiresTimestamp = null)
    {
        parent::__construct(trim($value));
        $this->setTimestamp($timestamp);
        $this->setExpiresTimestamp($expiresTimestamp);
    }

    /**
     * Gets time stamp
     *
     * @return int
     */
    public function getTimestamp()
    {
        return $this->getProperty('timestamp');
    }

    /**
     * Sets time stamp
     *
     * @param  int $timestamp
     * @return self
     */
    public function setTimestamp($timestamp)
    {
        $timestamp = (int) $timestamp < 0 ? time() : (int) $timestamp;
        return $this->setProperty('timestamp', $timestamp);
    }

    /**
     * Gets expiration time of the authtoken
     *
     * @return int
     */
    public function getExpiresTimestamp()
    {
        return $this->getProperty('expiresTimestamp');
    }

    /**
     * Sets expiration time of the authtoken
     *
     * @param  int $expiresTimestamp
     * @return self
     */
    public function setExpiresTimestamp($expiresTimestamp)
    {
        $expiresTimestamp = (int) $expiresTimestamp < 0 ? 0 : (int) $expiresTimestamp;
        return $this->setProperty('expiresTimestamp', $expiresTimestamp);
    }

    /**
     * Compute preauth value
     *
     * @param  string|AccountSelector $account The user account.
     * @param  string $key Pre authentication key.
     * @return self.
     */
    public function computeValue($account, $key)
    {
        $timestamp = ($this->getTimestamp() > 0) ? $this->getTimestamp() : time();
        $expire = $this->getExpiresTimestamp();
        if($account instanceof AccountSelector)
        {
            $preauth = $account->getValue() . '|'. $account->getBy() . '|' . $expire . '|' . $timestamp;
        }
        else
        {
            $preauth = $account . '|name|' . $expire . '|' . $timestamp;
        }
        $this->setValue(hash_hmac('sha1', $preauth, $key));
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'preauth')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'preauth')
    {
        return parent::toXml($name);
    }
}
