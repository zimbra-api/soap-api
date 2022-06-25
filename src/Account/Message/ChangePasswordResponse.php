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
use Zimbra\Soap\ResponseInterface;

/**
 * ChangePasswordResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ChangePasswordResponse implements ResponseInterface
{
    /**
     * New authToken, as old authToken is invalidated on password change.
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $authToken;

    /**
     * Life time associated with {new-auth-token}
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("integer")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $lifetime;

    /**
     * Constructor method for ChangePasswordResponse
     *
     * @param  string $authToken
     * @param  int $lifetime
     * @return self
     */
    public function __construct(string $authToken, int $lifetime)
    {
        $this->setAuthToken($authToken)
             ->setLifetime($lifetime);
    }

    /**
     * Gets new auth token
     *
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * Sets new auth token
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
     * Gets life time associated
     *
     * @return int
     */
    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    /**
     * Sets life time associated
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
