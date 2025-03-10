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
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * ChangePasswordRequest class
 * Change Password
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ChangePasswordRequest extends SoapRequest
{
    /**
     * Details of the account
     *
     * @var AccountSelector
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private AccountSelector $account;

    /**
     * Old password
     *
     * @var string
     */
    #[Accessor(getter: "getOldPassword", setter: "setOldPassword")]
    #[SerializedName("oldPassword")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private string $oldPassword;

    /**
     * New password to assign
     *
     * @var string
     */
    #[Accessor(getter: "getPassword", setter: "setPassword")]
    #[SerializedName("password")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private string $password;

    /**
     * Specified virtual-host is used to determine the domain of the account name
     *
     * @var string
     */
    #[Accessor(getter: "getVirtualHost", setter: "setVirtualHost")]
    #[SerializedName("virtualHost")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private ?string $virtualHost = null;

    /**
     * is dry run
     *
     * @var bool
     */
    #[Accessor(getter: "isDryRun", setter: "setDryRun")]
    #[SerializedName("dryRun")]
    #[Type("bool")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private ?bool $dryRun = null;

    /**
     * Auth token
     *
     * @var AuthToken
     */
    #[Accessor(getter: "getAuthToken", setter: "setAuthToken")]
    #[SerializedName("authToken")]
    #[Type(AuthToken::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?AuthToken $authToken;

    /**
     * Constructor
     *
     * @param  AccountSelector $account
     * @param  string $oldPassword
     * @param  string $newPassword
     * @param  string $virtualHost
     * @param  bool   $dryRun
     * @param  AuthToken $authToken
     * @return self
     */
    public function __construct(
        AccountSelector $account,
        string $oldPassword = "",
        string $newPassword = "",
        ?string $virtualHost = null,
        ?bool $dryRun = null,
        ?AuthToken $authToken = null
    ) {
        $this->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($newPassword);
        $this->authToken = $authToken;
        if (null !== $virtualHost) {
            $this->setVirtualHost($virtualHost);
        }
        if (null !== $dryRun) {
            $this->setDryRun($dryRun);
        }
    }

    /**
     * Get the account to authenticate against
     *
     * @return AccountSelector
     */
    public function getAccount(): AccountSelector
    {
        return $this->account;
    }

    /**
     * Set the account to authenticate against
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
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
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
     * Get old password
     *
     * @return string
     */
    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    /**
     * Set old password
     *
     * @param  string $password
     * @return self
     */
    public function setOldPassword(string $password): self
    {
        $this->oldPassword = $password;
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
     * Get dryRun
     *
     * @return bool
     */
    public function isDryRun(): ?bool
    {
        return $this->dryRun;
    }

    /**
     * Set dryRun
     *
     * @param  bool $dryRun
     * @return self
     */
    public function setDryRun(bool $dryRun): self
    {
        $this->dryRun = $dryRun;
        return $this;
    }

    /**
     * Get auth token
     *
     * @return AuthToken
     */
    public function getAuthToken(): ?AuthToken
    {
        return $this->authToken;
    }

    /**
     * Set auth token
     *
     * @param  AuthToken $authToken
     * @return self
     */
    public function setAuthToken(AuthToken $authToken): self
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ChangePasswordEnvelope(new ChangePasswordBody($this));
    }
}
