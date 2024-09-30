<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\SoapResponse;

/**
 * ChangePasswordResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ChangePasswordResponse extends SoapResponse
{
    /**
     * New authToken, as old authToken is invalidated on password change.
     *
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getAuthToken", setter: "setAuthToken")]
    #[SerializedName("authToken")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $authToken;

    /**
     * Life time associated with {new-auth-token}
     *
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var int
     */
    #[Accessor(getter: "getLifetime", setter: "setLifetime")]
    #[SerializedName("lifetime")]
    #[Type("int")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $lifetime;

    /**
     * Constructor
     *
     * @param  string $authToken
     * @param  int $lifetime
     * @return self
     */
    public function __construct(string $authToken = "", int $lifetime = 0)
    {
        $this->setAuthToken($authToken)->setLifetime($lifetime);
    }

    /**
     * Get new auth token
     *
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * Set new auth token
     *
     * @param  string $authToken
     * @return self
     */
    public function setAuthToken(string $authToken): self
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * Get life time associated
     *
     * @return int
     */
    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    /**
     * Set life time associated
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;
        return $this;
    }
}
