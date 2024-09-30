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
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * GetAdminConsoleUICompRequest class
 * Returns the union of the zimbraAdminConsoleUIComponents values on the specified account/dl entry and that on all admin groups the entry belongs to.
 * Note: if neither <account> nor <dl> is specified, the authed admin account will be used as the perspective entry.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAdminConsoleUICompRequest extends SoapRequest
{
    /**
     * Account
     *
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var AccountSelector
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?AccountSelector $account;

    /**
     * Distribution List
     *
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Admin\Struct\DistributionListSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var DlSelector
     */
    #[Accessor(getter: "getDl", setter: "setDl")]
    #[SerializedName("dl")]
    #[Type(DlSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?DlSelector $dl;

    /**
     * Constructor
     *
     * @param  AccountSelector $account
     * @param  DlSelector $dl
     * @return self
     */
    public function __construct(
        ?AccountSelector $account = null,
        ?DlSelector $dl = null
    ) {
        $this->account = $account;
        $this->dl = $dl;
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
     * Get the dl.
     *
     * @return DlSelector
     */
    public function getDl(): ?DlSelector
    {
        return $this->dl;
    }

    /**
     * Set the dl.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAdminConsoleUICompEnvelope(
            new GetAdminConsoleUICompBody($this)
        );
    }
}
