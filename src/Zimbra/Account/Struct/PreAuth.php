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
     * @param  string $value
     * @param  int    $expiresTimestamp
     * @return self
     */
    public function __construct($timestamp, $value = null, $expiresTimestamp = null)
    {
		parent::__construct(trim($value));
		$this->property('timestamp', (int) $timestamp);
		$this->property('expiresTimestamp', (int) $expiresTimestamp);
    }

    /**
     * Gets or sets timestamp
     *
     * @param  int $timestamp
     * @return int|self
     */
    public function timestamp($timestamp = null)
    {
        if(null === $timestamp)
        {
            return $this->property('timestamp');
        }
        return $this->property('timestamp', (int) $timestamp);
    }

    /**
     * Gets or sets expiresTimestamp
     *
     * @param  int $expiresTimestamp
     * @return int|self
     */
    public function expiresTimestamp($expiresTimestamp = null)
    {
        if(null === $expiresTimestamp)
        {
            return $this->property('expiresTimestamp');
        }
        return $this->property('expiresTimestamp', (int) $expiresTimestamp);
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
        $timestamp = ($this->timestamp() > 0) ? $this->timestamp() : time();
        $expire = $this->expiresTimestamp();
        if($account instanceof AccountSelector)
        {
            $preauth = $account->value() . '|'. $account->by() . '|' . $expire . '|' . $timestamp;
        }
        else
        {
            $preauth = $account . '|name|' . $expire . '|' . $timestamp;
        }
        $this->value(hash_hmac('sha1', $preauth, $key));
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
