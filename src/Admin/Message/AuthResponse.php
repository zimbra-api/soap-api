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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * AuthResponse class
 * Authenticate for administration
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AuthResponse implements SoapResponseInterface
{

    /**
     * Auth token
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $authToken;

    /**
     * If client is CSRF token enabled , the CSRF token Returned only when client says it is CSRF enabled.
     * @Accessor(getter="getCsrfToken", setter="setCsrfToken")
     * @SerializedName("csrfToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $csrfToken;

    /**
     * Life time for the authorization
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $lifetime;

    /**
     * Constructor method for AuthResponse
     *
     * @param string $authToken
     * @param string $csrfToken
     * @param int    $lifetime
     * @return self
     */
    public function __construct(
        ?string $authToken = NULL,
        ?string $csrfToken = NULL,
        ?int $lifetime = NULL
    )
    {
        if (NULL !== $authToken) {
            $this->setAuthToken($authToken);
        }
        if (NULL !== $csrfToken) {
            $this->setCsrfToken($csrfToken);
        }
        if (NULL !== $lifetime) {
            $this->setLifetime($lifetime);
        }
    }

    /**
     * Get auth token
     *
     * @return string
     */
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    /**
     * Set auth token
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
     * Get csrf token
     *
     * @return string
     */
    public function getCsrfToken(): ?string
    {
        return $this->csrfToken;
    }

    /**
     * Set csrf token
     *
     * @param  string $csrfToken
     * @return self
     */
    public function setCsrfToken(string $csrfToken): self
    {
        $this->csrfToken = $csrfToken;
        return $this;
    }

    /**
     * Get lifetime
     *
     * @return int
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * Set lifetime
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
