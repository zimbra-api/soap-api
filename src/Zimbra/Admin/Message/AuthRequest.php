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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Soap\{EnvelopeInterface, RequestInterface};
use Zimbra\Struct\AccountSelector as Account;

/**
 * AuthRequest class
 * Authenticate for administration
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AuthRequest")
 */
class AuthRequest implements RequestInterface
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
     * An authToken can be passed instead of account/password/name to validate an existing auth token.
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $authToken;

    /**
     * Account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement()
     */
    private $account;

    /**
     * Virtual host
     * @Accessor(getter="getVirtualHost", setter="setVirtualHost")
     * @SerializedName("virtualHost")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $virtualHost;

    /**
     * Controls whether the auth token cookie in the response should be persisted when the browser exits.
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
     * the TOTP code used for two-factor authentication
     * @Accessor(getter="getTwoFactorCode", setter="setTwoFactorCode")
     * @SerializedName("twoFactorCode")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $twoFactorCode;

    /**
     * Constructor method for AuthRequest
     * @param string  $name Name. Only one of {auth-name} or <account> can be specified
     * @param string  $password Password - must be present if not using AuthToken
     * @param string  $authToken An authToken can be passed instead of account/password/name to validate an existing auth authToken.
     * @param Account $account The account
     * @param string  $virtualHost Virtual host
     * @param bool    $persistAuthTokenCookie Controls whether the auth authToken cookie in the response should be persisted when the browser exits.
     * @param bool    $csrfSupported Controls whether the client supports CSRF token
     * @param string  $twoFactorCode The TOTP code used for two-factor authentication
     * @return self
     */
    public function __construct(
        $name = NULL,
        $password = NULL,
        $authToken = NULL,
        Account $account = NULL,
        $virtualHost = NULL,
        $persistAuthTokenCookie = NULL,
        $csrfSupported = NULL,
        $twoFactorCode = NULL
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
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password): self
    {
        $this->password = trim($password);
        return $this;
    }

    /**
     * Gets auth token
     *
     * @return string
     */
    public function getAuthToken(): ?string
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
     * Gets the account.
     *
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * Sets the account.
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
     * Gets virtual host
     *
     * @return string
     */
    public function getVirtualHost(): ?string
    {
        return $this->virtualHost;
    }

    /**
     * Sets virtual host
     *
     * @param  string $virtualHost
     * @return self
     */
    public function setVirtualHost($virtualHost): self
    {
        $this->virtualHost = trim($virtualHost);
        return $this;
    }

    /**
     * Gets persistAuthTokenCookie flag
     *
     * @return bool
     */
    public function getPersistAuthTokenCookie()
    {
        return $this->persistAuthTokenCookie;
    }

    /**
     * Sets persistAuthTokenCookie flag
     *
     * @param  bool $persistAuthTokenCookie
     * @return self
     */
    public function setPersistAuthTokenCookie($persistAuthTokenCookie): self
    {
        $this->persistAuthTokenCookie = (bool) $persistAuthTokenCookie;
        return $this;
    }

    /**
     * Gets csrfSupported flag
     *
     * @return bool
     */
    public function getCsrfSupported()
    {
        return $this->csrfSupported;
    }

    /**
     * Sets csrfSupported flag
     *
     * @param  bool $csrfSupported
     * @return self
     */
    public function setCsrfSupported($csrfSupported): self
    {
        $this->csrfSupported = (bool) $csrfSupported;
        return $this;
    }

    /**
     * Gets  the TOTP code used for two-factor authentication
     *
     * @return string
     */
    public function getTwoFactorCode(): ?string
    {
        return $this->twoFactorCode;
    }

    /**
     * Sets  the TOTP code used for two-factor authentication
     *
     * @param  string $twoFactorCode
     * @return self
     */
    public function setTwoFactorCode($twoFactorCode): self
    {
        $this->twoFactorCode = trim($twoFactorCode);
        return $this;
    }

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        return new AuthEnvelope(
            new AuthBody($this)
        );
    }
}
