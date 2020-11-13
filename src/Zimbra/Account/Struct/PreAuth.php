<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};
use Zimbra\Struct\AccountSelector;

/**
 * PreAuth struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="preauth")
 */
class PreAuth
{
    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * @Accessor(getter="getTimestamp", setter="setTimestamp")
     * @SerializedName("timestamp")
     * @Type("integer")
     * @XmlAttribute
     */
    private $timestamp;

    /**
     * @Accessor(getter="getExpiresTimestamp", setter="setExpiresTimestamp")
     * @SerializedName("expiresTimestamp")
     * @Type("integer")
     * @XmlAttribute
     */
    private $expiresTimestamp;

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
    public function __construct($timestamp, $value = NULL, $expiresTimestamp = NULL)
    {
        $this->setTimestamp($timestamp);
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $expiresTimestamp) {
            $expiresTimestamp = (int) $expiresTimestamp < 0 ? time() : (int) $expiresTimestamp;
            $this->setExpiresTimestamp($expiresTimestamp);
        }
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->value = trim($value);
        return $this;
    }

    /**
     * Gets time stamp
     *
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
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
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Gets expiration time of the authtoken
     *
     * @return int
     */
    public function getExpiresTimestamp()
    {
        return $this->expiresTimestamp;
    }

    /**
     * Sets expiration time of the authtoken
     *
     * @param  int $expiresTimestamp
     * @return self
     */
    public function setExpiresTimestamp($expiresTimestamp)
    {
        $expiresTimestamp = (int) $expiresTimestamp < 0 ? time() : (int) $expiresTimestamp;
        $this->expiresTimestamp = $expiresTimestamp;
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
        $timestamp = ($this->getTimestamp() > 0) ? $this->getTimestamp() : time();
        $expire = $this->getExpiresTimestamp();
        if ($account instanceof AccountSelector) {
            $preauth = $account->getValue() . '|'. $account->getBy() . '|' . $expire . '|' . $timestamp;
        }
        else {
            $preauth = $account . '|name|' . $expire . '|' . $timestamp;
        }
        $this->setValue(hash_hmac('sha1', $preauth, $key));
        return $this;
    }
}
