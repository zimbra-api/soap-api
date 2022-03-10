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
use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector;

/**
 * ChangePasswordRequest class
 * Change Password
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ChangePasswordRequest extends Request
{
    /**
     * Details of the account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

    /**
     * Old password
     * @Accessor(getter="getOldPassword", setter="setOldPassword")
     * @SerializedName("oldPassword")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $oldPassword;

    /**
     * New Password to assign
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $password;

    /**
     * specified virtual-host is used to determine the domain of the account name
     * @Accessor(getter="getVirtualHost", setter="setVirtualHost")
     * @SerializedName("virtualHost")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $virtualHost;

    /**
     * 
     * @Accessor(getter="isDryRun", setter="setDryRun")
     * @SerializedName("dryRun")
     * @Type("bool")
     * @XmlElement(cdata = false)
     */
    private $dryRun;

    /**
     * Constructor method for ChangePasswordRequest
     *
     * @param  AccountSelector $account
     * @param  string $oldPassword
     * @param  string $newPassword
     * @param  string $virtualHost
     * @param  bool   $dryRun
     * @return self
     */
    public function __construct(
        AccountSelector $account,
        string $oldPassword,
        string $newPassword,
        ?string $virtualHost = NULL,
        ?bool $dryRun = NULL
    )
    {
        $this->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($newPassword);
        if(NULL !== $virtualHost) {
            $this->setVirtualHost($virtualHost);
        }
        if(NULL !== $dryRun) {
            $this->setDryRun($dryRun);
        }
    }

    /**
     * Gets the account to authenticate against
     *
     * @return AccountSelector
     */
    public function getAccount(): AccountSelector
    {
        return $this->account;
    }

    /**
     * Sets the account to authenticate against
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
     * Gets password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets password
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
     * Gets old password
     *
     * @return string
     */
    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    /**
     * Sets old password
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
    public function setVirtualHost(string $virtualHost): self
    {
        $this->virtualHost = $virtualHost;
        return $this;
    }

    /**
     * Gets dryRun
     *
     * @return bool
     */
    public function isDryRun(): ?bool
    {
        return $this->dryRun;
    }

    /**
     * Sets dryRun
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ChangePasswordEnvelope)) {
            $this->envelope = new ChangePasswordEnvelope(
                new ChangePasswordBody($this)
            );
        }
    }
}
