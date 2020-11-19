<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Soap\ResponseInterface;

/**
 * DelegateAuthResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DelegateAuthResponse")
 */
class DelegateAuthResponse implements ResponseInterface
{
    /**
     * Auth token
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $authToken;

    /**
     * Life time for the authorization
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("int")
     * @XmlElement(cdata=false)
     */
    private $lifetime;

    /**
     * Constructor method for DelegateAuthResponse
     * @param string $authToken
     * @param int    $lifetime
     * @return self
     */
    public function __construct($authToken, $lifetime)
    {
        $this->setAuthToken($authToken)
             ->setLifetime($lifetime);
    }

    /**
     * Gets auth token
     *
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * Sets auth token
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
     * Gets lifetime
     *
     * @return int
     */
    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    /**
     * Sets lifetime
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
