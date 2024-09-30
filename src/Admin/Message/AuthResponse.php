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
use Zimbra\Common\Struct\SoapResponse;

/**
 * AuthResponse class
 * Authenticate for administration
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AuthResponse extends SoapResponse
{
    /**
     * Auth token
     *
     * @var string
     */
    #[Accessor(getter: "getAuthToken", setter: "setAuthToken")]
    #[SerializedName("authToken")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $authToken;

    /**
     * If client is CSRF token enabled , the CSRF token Returned only when client says it is CSRF enabled.
     *
     * @var string
     */
    #[Accessor(getter: "getCsrfToken", setter: "setCsrfToken")]
    #[SerializedName("csrfToken")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $csrfToken;

    /**
     * Life time for the authorization
     *
     * @var int
     */
    #[Accessor(getter: "getLifetime", setter: "setLifetime")]
    #[SerializedName("lifetime")]
    #[Type("int")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $lifetime;

    /**
     * Two Factor Auth Required
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getTwoFactorAuthRequired",
            setter: "setTwoFactorAuthRequired"
        )
    ]
    #[SerializedName("twoFactorAuthRequired")]
    #[Type("bool")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $twoFactorAuthRequired;

    /**
     * Constructor
     *
     * @param string $authToken
     * @param string $csrfToken
     * @param int    $lifetime
     * @param bool   $twoFactorAuthRequired
     * @return self
     */
    public function __construct(
        ?string $authToken = null,
        ?string $csrfToken = null,
        ?int $lifetime = null,
        ?bool $twoFactorAuthRequired = null
    ) {
        if (null !== $authToken) {
            $this->setAuthToken($authToken);
        }
        if (null !== $csrfToken) {
            $this->setCsrfToken($csrfToken);
        }
        if (null !== $lifetime) {
            $this->setLifetime($lifetime);
        }
        if (null !== $twoFactorAuthRequired) {
            $this->setTwoFactorAuthRequired($twoFactorAuthRequired);
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

    /**
     * Get twoFactorAuthRequired
     *
     * @return bool
     */
    public function getTwoFactorAuthRequired(): ?bool
    {
        return $this->twoFactorAuthRequired;
    }

    /**
     * Set twoFactorAuthRequired
     *
     * @param  bool $twoFactorAuthRequired
     * @return self
     */
    public function setTwoFactorAuthRequired(bool $twoFactorAuthRequired): self
    {
        $this->twoFactorAuthRequired = $twoFactorAuthRequired;
        return $this;
    }
}
