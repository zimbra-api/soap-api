<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * PreAuth class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class PreAuth
{
    /**
     * Time stamp
     * - use : required
     * @var int
     */
    private $_timestamp;

    /**
     * Computed preauth value
     * @var string
     */
    private $_value;

    /**
     * Expiration time of the authtoken
     * @var int
     */
    private $_expiresTimestamp;

    /**
     * Constructor method for preAuth
     * @param  int    $timestamp
     * @param  string $value
     * @param  int    $expiresTimestamp
     * @return self
     */
    public function __construct($timestamp, $value = null, $expiresTimestamp = null)
    {
        $this->_timestamp = (int) $timestamp;
        $this->_value = trim($value);
        $this->_expiresTimestamp = (int) $expiresTimestamp;
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
            return (int) $this->_timestamp;
        }
        $this->_timestamp = (int) $timestamp;
        return $this;
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
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
            return (int) $this->_expiresTimestamp;
        }
        $this->_expiresTimestamp = (int) $expiresTimestamp;
        return $this;
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
        $timestamp = ($this->_timestamp > 0) ? $this->_timestamp : time();
        $expire = $this->_expiresTimestamp;
        if($account instanceof AccountSelector)
        {
            $preauth = $account->value() . '|'. $account->by() . '|' . $expire . '|' . $timestamp;
        }
        else
        {
            $preauth = $account . '|name|' . $expire . '|' . $timestamp;
        }
        $this->_value = hash_hmac('sha1', $preauth, $key);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'preauth')
    {
        $name = !empty($name) ? $name : 'preauth';
        $arr = array(
            'timestamp' => $this->_timestamp,
            '_' => $this->_value,
        );
        if(is_int($this->_expiresTimestamp))
        {
            $arr['expiresTimestamp'] = $this->_expiresTimestamp;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'preauth')
    {
        $name = !empty($name) ? $name : 'preauth';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('timestamp', $this->_timestamp);
        if(is_int($this->_expiresTimestamp))
        {
            $xml->addAttribute('expiresTimestamp', $this->_expiresTimestamp);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
