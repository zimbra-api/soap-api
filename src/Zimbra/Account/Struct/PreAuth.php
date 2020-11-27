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
     * Computed preauth value
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Time stamp
     * @Accessor(getter="getTimestamp", setter="setTimestamp")
     * @SerializedName("timestamp")
     * @Type("integer")
     * @XmlAttribute
     */
    private $timestamp;

    /**
     * Expiration time of the authtoken, in milliseconds.
     * Set to 0 to use the default expiration time for the account.
     * Can be used to sync the auth token expiration time with the external system's notion of expiration (like a Kerberos TGT lifetime, for example).
     * @Accessor(getter="getExpiresTimestamp", setter="setExpiresTimestamp")
     * @SerializedName("expiresTimestamp")
     * @Type("integer")
     * @XmlAttribute
     */
    private $expiresTimestamp;

    /**
     * Constructor method for PreAuth
     * @param  int    $timestamp
     * @param  string $value
     * @param  int    $expiresTimestamp
     * @return self
     */
    public function __construct(int $timestamp, ?string $value = NULL, ?int $expiresTimestamp = NULL)
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
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets time stamp
     *
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * Sets time stamp
     *
     * @param  int $timestamp
     * @return self
     */
    public function setTimestamp(int $timestamp): self
    {
        $timestamp = $timestamp < 0 ? time() : $timestamp;
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Gets expiration time of the authtoken
     *
     * @return int
     */
    public function getExpiresTimestamp(): ?int
    {
        return $this->expiresTimestamp;
    }

    /**
     * Sets expiration time of the authtoken
     *
     * @param  int $expiresTimestamp
     * @return self
     */
    public function setExpiresTimestamp(int $expiresTimestamp): self
    {
        $expiresTimestamp = $expiresTimestamp < 0 ? time() : $expiresTimestamp;
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
    public function computeValue($account, string $key): self
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
