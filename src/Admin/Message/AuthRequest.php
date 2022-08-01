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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\AccountSelector as Account;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute()
     */
    private $name;

    /**
     * Password - must be present if not using AuthToken
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlAttribute()
     */
    private $password;

    /**
     * An authToken can be passed instead of account/password/name to validate an existing auth authToken.
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $authToken;

    /**
     * The account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Account $account = NULL;

    /**
     * Virtual host
     * @Accessor(getter="getVirtualHost", setter="setVirtualHost")
     * @SerializedName("virtualHost")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $virtualHost;

    /**
     * Controls whether the auth authToken cookie in the response should be persisted when the browser exits.
     * @Accessor(getter="getPersistAuthTokenCookie", setter="setPersistAuthTokenCookie")
     * @SerializedName("persistAuthTokenCookie")
     * @Type("bool")
     * @XmlAttribute()
     */
    private $persistAuthTokenCookie;

    /**
     * Controls whether the client supports CSRF token
     * @Accessor(getter="getCsrfSupported", setter="setCsrfSupported")
     * @SerializedName("csrfTokenSecured")
     * @Type("bool")
     * @XmlAttribute
     */
    private $csrfSupported;

    /**
     * The TOTP code used for two-factor authentication
     * @Accessor(getter="getTwoFactorCode", setter="setTwoFactorCode")
     * @SerializedName("twoFactorCode")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $twoFactorCode;

    /**
     * Constructor method for AuthRequest
     *
     * @param string  $name
     * @param string  $password
     * @param string  $authToken
     * @param Account $account
     * @param string  $virtualHost
     * @param bool    $persistAuthTokenCookie
     * @param bool    $csrfSupported
     * @param string  $twoFactorCode
     * @return self
     */
    public function __construct(
        ?string $name = NULL,
        ?string $password = NULL,
        ?string $authToken = NULL,
        ?Account $account = NULL,
        ?string $virtualHost = NULL,
        ?bool $persistAuthTokenCookie = NULL,
        ?bool $csrfSupported = NULL,
        ?string $twoFactorCode = NULL
    )
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $password){
            $this->setPassword($password);
        }
        if (NULL !== $authToken) {
            $this->setAuthToken($authToken);
        }
        if ($account instanceof Account) {
            $this->setAccount($account);
        }
        if (NULL !== $virtualHost) {
            $this->setVirtualHost($virtualHost);
        }
        if (NULL !== $persistAuthTokenCookie) {
            $this->setPersistAuthTokenCookie($persistAuthTokenCookie);
        }
        if (NULL !== $csrfSupported) {
            $this->setCsrfSupported($csrfSupported);
        }
        if (NULL !== $twoFactorCode) {
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
     * @return Account
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account): self
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
    public function setPersistAuthTokenCookie(bool $persistAuthTokenCookie): self
    {
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
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AuthEnvelope(
            new AuthBody($this)
        );
    }
}
