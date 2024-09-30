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
use Zimbra\Common\Struct\{
    AccountSelector,
    GranteeChooser,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * GetShareInfoRequest request class
 * Iterate through all folders of the owner's mailbox and return shares that match grantees specified by the <grantee> specifier.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetShareInfoRequest extends SoapRequest
{
    /**
     * Grantee
     *
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Common\Struct\GranteeChooser")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var GranteeChooser
     */
    #[Accessor(getter: "getGrantee", setter: "setGrantee")]
    #[SerializedName("grantee")]
    #[Type(GranteeChooser::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?GranteeChooser $grantee;

    /**
     * Owner
     *
     * @Accessor(getter="getOwner", setter="setOwner")
     * @SerializedName("owner")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var AccountSelector
     */
    #[Accessor(getter: "getOwner", setter: "setOwner")]
    #[SerializedName("owner")]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private AccountSelector $owner;

    /**
     * Constructor
     *
     * @param  AccountSelector $owner
     * @param  GranteeChooser $grantee
     * @return self
     */
    public function __construct(
        AccountSelector $owner,
        ?GranteeChooser $grantee = null
    ) {
        $this->setOwner($owner);
        $this->grantee = $grantee;
    }

    /**
     * Get the grantee.
     *
     * @return GranteeChooser
     */
    public function getGrantee(): ?GranteeChooser
    {
        return $this->grantee;
    }

    /**
     * Set the grantee.
     *
     * @param  GranteeChooser $grantee
     * @return self
     */
    public function setGrantee(GranteeChooser $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Set the owner.
     *
     * @return AccountSelector
     */
    public function getOwner(): AccountSelector
    {
        return $this->owner;
    }

    /**
     * Set the owner.
     *
     * @param  AccountSelector $owner
     * @return self
     */
    public function setOwner(AccountSelector $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetShareInfoEnvelope(new GetShareInfoBody($this));
    }
}
