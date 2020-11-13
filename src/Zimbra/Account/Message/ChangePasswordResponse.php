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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Soap\ResponseInterface;

/**
 * ChangePasswordResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ChangePasswordResponse", namespace="urn:zimbraAccount")
 */
class ChangePasswordResponse implements ResponseInterface
{
    /**
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $authToken;

    /**
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("integer")
     * @XmlElement(cdata = false)
     */
    private $lifetime;

    /**
     * Constructor method for ChangePasswordResponse
     * @param  string $authToken Auth token based on the new password
     * @param  string $lifetime Life time of the auth token
     * @return self
     */
    public function __construct($authToken, $lifetime)
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
    public function setAuthToken($authToken): self
    {
        $this->authToken = trim($authToken);
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
    public function setLifetime($lifetime): self
    {
        $this->lifetime = (int) $lifetime;
        return $this;
    }
}
