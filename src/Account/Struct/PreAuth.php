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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Struct\AccountSelector;

/**
 * PreAuth struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class PreAuth
{
    /**
     * Computed preauth value
     * @Accessor(getter="getValue", setter="setValue")
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
     * @SerializedName("expires")
     * @Type("integer")
     * @XmlAttribute
     */
    private $expiresTimestamp;

    /**
     * Constructor
     * 
     * @param  AccountSelector $account
     * @param  string $preauthKey
     * @param  int    $timestamp
     * @param  int    $expiresTimestamp
     * @return self
     */
    public function __construct(
        AccountSelector $account,
        string $preauthKey = '',
        int $timestamp = 0,
        int $expiresTimestamp = 0
    )
    {
        $this->setTimestamp($timestamp)
             ->setExpiresTimestamp($expiresTimestamp)
             ->computeValue($account, $preauthKey);
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
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
     * Get time stamp
     *
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * Set time stamp
     *
     * @param  int $timestamp
     * @return self
     */
    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp < 0 ? time() : $timestamp;
        return $this;
    }

    /**
     * Get expiration time of the authtoken
     *
     * @return int
     */
    public function getExpiresTimestamp(): ?int
    {
        return $this->expiresTimestamp;
    }

    /**
     * Set expiration time of the authtoken
     *
     * @param  int $expiresTimestamp
     * @return self
     */
    public function setExpiresTimestamp(int $expiresTimestamp): self
    {
        $this->expiresTimestamp = $expiresTimestamp < 0 ? time() : $expiresTimestamp;
        return $this;
    }

    /**
     * Compute preauth value
     *
     * @param  AccountSelector $account
     * @param  string $preauthKey
     * @return self
     */
    public function computeValue(AccountSelector $account, string $preauthKey): self
    {
        $timestamp = ($this->getTimestamp() > 0) ? $this->getTimestamp() : time();
        $expire = $this->getExpiresTimestamp();
        $preauth = $account->getValue() . '|'. $account->getBy() . '|' . $expire . '|' . $timestamp;
        return $this->setValue(hash_hmac('sha1', $preauth, $preauthKey));
    }
}
