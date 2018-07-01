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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * AuthToken struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="authToken")
 */
class AuthToken
{
    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * @Accessor(getter="getVerifyAccount", setter="setVerifyAccount")
     * @SerializedName("verifyAccount")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_verifyAccount;

    /**
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("int")
     * @XmlAttribute
     */
    private $_lifetime;

    /**
     * Constructor method for AuthToken
     * @param  string $value
     *   Value for authorization token
     * @param  bool   $verifyAccount
     *   If verifyAccount="1", account is required and the account in the auth token is compared to the named account.
     *   If verifyAccount="0" (default), only the auth token is verified and any account element specified is ignored.
     * @param  int   $lifetime
     *   Life time of the auth token
     * @return self
     */
    public function __construct($value, $verifyAccount = null, $lifetime = null)
    {
        $this->setValue($value);
        if (null !== $verifyAccount) {
            $this->setVerifyAccount($verifyAccount);
        }
        if (null !== $lifetime) {
            $this->setLifetime($lifetime);
        }
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets auth token is verified flag
     *
     * @return bool
     */
    public function getVerifyAccount()
    {
        return $this->_verifyAccount;
    }

    /**
     * Sets auth token is verified flag
     *
     * @param  bool $verifyAccount
     * @return self
     */
    public function setVerifyAccount($verifyAccount)
    {
        $this->_verifyAccount = (bool) $verifyAccount;
        return $this;
    }

    /**
     * Gets life time of the auth token
     *
     * @return int
     */
    public function getLifetime()
    {
        return $this->_lifetime;
    }

    /**
     * Sets life time of the auth token
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime($lifetime)
    {
        $this->_lifetime = (int) $lifetime;
        return $this;
    }
}
