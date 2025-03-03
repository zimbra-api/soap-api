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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * AuthRequest class
 * Authenticate for administration
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AuthRequest extends SoapRequest
{
    /**
     * Name. Only one of {auth-name} or <account> can be specified
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $name = null;

    /**
     * Password - must be present if not using AuthToken
     *
     * @var string
     */
    #[Accessor(getter: "getPassword", setter: "setPassword")]
    #[SerializedName("password")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $password = null;

    /**
     * An authToken can be passed instead of account/password/name to validate an existing auth authToken.
     *
     * @var string
     */
    #[Accessor(getter: "getAuthToken", setter: "setAuthToken")]
    #[SerializedName("authToken")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private ?string $authToken = null;

    /**
     * The account
     *
     * @var AccountSelector
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?AccountSelector $account;

    /**
     * Virtual host
     *
     * @var string
     */
    #[Accessor(getter: "getVirtualHost", setter: "setVirtualHost")]
    #[SerializedName("virtualHost")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private ?string $virtualHost = null;

    /**
     * Controls whether the auth authToken cookie in the response should be persisted when the browser exits.
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getPersistAuthTokenCookie",
            setter: "setPersistAuthTokenCookie"
        )
    ]
    #[SerializedName("persistAuthTokenCookie")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $persistAuthTokenCookie = null;

    /**
     * Controls whether the client supports CSRF token
     *
     * @var bool
     */
    #[Accessor(getter: "getCsrfSupported", setter: "setCsrfSupported")]
    #[SerializedName("csrfTokenSecured")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $csrfSupported = null;

    /**
     * The TOTP code used for two-factor authentication
     *
     * @var string
     */
    #[Accessor(getter: "getTwoFactorCode", setter: "setTwoFactorCode")]
    #[SerializedName("twoFactorCode")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private ?string $twoFactorCode = null;

    /**
     * Constructor
     *
     * @param string  $name
     * @param string  $password
     * @param string  $authToken
     * @param AccountSelector $account
     * @param string  $virtualHost
     * @param bool    $persistAuthTokenCookie
     * @param bool    $csrfSupported
     * @param string  $twoFactorCode
     * @return self
     */
    public function __construct(
        ?string $name = null,
        ?string $password = null,
        ?string $authToken = null,
        ?AccountSelector $account = null,
        ?string $virtualHost = null,
        ?bool $persistAuthTokenCookie = null,
        ?bool $csrfSupported = null,
        ?string $twoFactorCode = null
    ) {
        $this->account = $account;
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $password) {
            $this->setPassword($password);
        }
        if (null !== $authToken) {
            $this->setAuthToken($authToken);
        }
        if (null !== $virtualHost) {
            $this->setVirtualHost($virtualHost);
        }
        if (null !== $persistAuthTokenCookie) {
            $this->setPersistAuthTokenCookie($persistAuthTokenCookie);
        }
        if (null !== $csrfSupported) {
            $this->setCsrfSupported($csrfSupported);
        }
        if (null !== $twoFactorCode) {
            $this->setTwoFactorCode($twoFactorCode);
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
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
     * Get the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): ?AccountSelector
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Get virtual host
     *
     * @return string
     */
    public function getVirtualHost(): ?string
    {
        return $this->virtualHost;
    }

    /**
     * Set virtual host
     *
     * @param  string $virtualHost
     * @return self
     */
    public function setVirtualHost(string $virtualHost): self
    {
        $this->virtualHost = $virtualHost;
        return $this;
    }

    /**
     * Get persistAuthTokenCookie flag
     *
     * @return bool
     */
    public function getPersistAuthTokenCookie(): ?bool
    {
        return $this->persistAuthTokenCookie;
    }

    /**
     * Set persistAuthTokenCookie flag
     *
     * @param  bool $persistAuthTokenCookie
     * @return self
     */
    public function setPersistAuthTokenCookie(
        bool $persistAuthTokenCookie
    ): self {
        $this->persistAuthTokenCookie = $persistAuthTokenCookie;
        return $this;
    }

    /**
     * Get csrfSupported flag
     *
     * @return bool
     */
    public function getCsrfSupported(): ?bool
    {
        return $this->csrfSupported;
    }

    /**
     * Set csrfSupported flag
     *
     * @param  bool $csrfSupported
     * @return self
     */
    public function setCsrfSupported(bool $csrfSupported): self
    {
        $this->csrfSupported = $csrfSupported;
        return $this;
    }

    /**
     * Get  the TOTP code used for two-factor authentication
     *
     * @return string
     */
    public function getTwoFactorCode(): ?string
    {
        return $this->twoFactorCode;
    }

    /**
     * Set  the TOTP code used for two-factor authentication
     *
     * @param  string $twoFactorCode
     * @return self
     */
    public function setTwoFactorCode(string $twoFactorCode): self
    {
        $this->twoFactorCode = $twoFactorCode;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AuthEnvelope(new AuthBody($this));
    }
}
