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
use Zimbra\Admin\Struct\DistributionListSelector as DlSelector;
use Zimbra\Struct\AccountSelector;
use Zimbra\Soap\Request;

/**
 * GetAdminConsoleUICompRequest class
 * Returns the union of the zimbraAdminConsoleUIComponents values on the specified account/dl entry and that on all admin groups the entry belongs to. 
 * Note: if neither <account> nor <dl> is specified, the authed admin account will be used as the perspective entry.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAdminConsoleUICompRequest extends Request
{
    /**
     * Account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

    /**
     * Distribution List
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Admin\Struct\DistributionListSelector")
     * @XmlElement
     */
    private $dl;

    /**
     * Constructor method for GetAdminConsoleUICompRequest
     * 
     * @param  AccountSelector $account
     * @param  DlSelector $dl
     * @return self
     */
    public function __construct(?AccountSelector $account = NULL, ?DlSelector $dl = NULL)
    {
        if ($account instanceof AccountSelector) {
            $this->setAccount($account);
        }
        if ($dl instanceof DlSelector) {
            $this->setDl($dl);
        }
    }

    /**
     * Gets the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): ?AccountSelector
    {
        return $this->account;
    }

    /**
     * Sets the account.
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
     * Gets the dl.
     *
     * @return DlSelector
     */
    public function getDl(): ?DlSelector
    {
        return $this->dl;
    }

    /**
     * Sets the dl.
     *
     * @param  DlSelector $dl
     * @return self
     */
    public function setDl(DlSelector $dl): self
    {
        $this->dl = $dl;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAdminConsoleUICompEnvelope)) {
            $this->envelope = new GetAdminConsoleUICompEnvelope(
                new GetAdminConsoleUICompBody($this)
            );
        }
    }
}
