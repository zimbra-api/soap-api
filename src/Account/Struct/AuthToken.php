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

/**
 * AuthToken struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AuthToken
{
    /**
     * Value for authorization token
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * If verifyAccount="1", account is required and the account in the auth token is compared to the named account.
     * If verifyAccount="0" (default), only the auth token is verified and any account element specified is ignored.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getVerifyAccount', setter: 'setVerifyAccount')]
    #[SerializedName('verifyAccount')]
    #[Type('bool')]
    #[XmlAttribute]
    private $verifyAccount;

    /**
     * Life time of the auth token
     * 
     * @var int
     */
    #[Accessor(getter: 'getLifetime', setter: 'setLifetime')]
    #[SerializedName('lifetime')]
    #[Type('int')]
    #[XmlAttribute]
    private $lifetime;

    /**
     * Constructor
     * 
     * @param  string $value
     * @param  bool   $verifyAccount
     * @param  int    $lifetime
     * @return self
     */
    public function __construct(
        string $value = '', ?bool $verifyAccount = null, ?int $lifetime = null
    )
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
     * Get value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get auth token is verified flag
     *
     * @return bool
     */
    public function getVerifyAccount(): ?bool
    {
        return $this->verifyAccount;
    }

    /**
     * Set auth token is verified flag
     *
     * @param  bool $verifyAccount
     * @return self
     */
    public function setVerifyAccount(bool $verifyAccount)
    {
        $this->verifyAccount = $verifyAccount;
        return $this;
    }

    /**
     * Get life time of the auth token
     *
     * @return int
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * Set life time of the auth token
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime(int $lifetime)
    {
        $this->lifetime = $lifetime;
        return $this;
    }
}
