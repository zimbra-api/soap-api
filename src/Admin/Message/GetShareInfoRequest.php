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
use Zimbra\Common\Struct\AccountSelector as Account;
use Zimbra\Common\Struct\GranteeChooser as Grantee;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetShareInfoRequest request class
 * Iterate through all folders of the owner's mailbox and return shares that match grantees specified by the <grantee> specifier. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetShareInfoRequest extends SoapRequest
{
    /**
     * Grantee
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Common\Struct\GranteeChooser")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Grantee $grantee = NULL;

    /**
     * Owner
     * @Accessor(getter="getOwner", setter="setOwner")
     * @SerializedName("owner")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private Account $owner;

    /**
     * Constructor method for GetShareInfoRequest
     *
     * @param  Account $owner
     * @param  Grantee $grantee
     * @return self
     */
    public function __construct(Account $owner, ?Grantee $grantee = NULL)
    {
        $this->setOwner($owner);
        if ($grantee instanceof Grantee) {
            $this->setGrantee($grantee);
        }
    }

    /**
     * Gets the grantee.
     *
     * @return Grantee
     */
    public function getGrantee(): ?Grantee
    {
        return $this->grantee;
    }

    /**
     * Sets the grantee.
     *
     * @param  Grantee $grantee
     * @return self
     */
    public function setGrantee(Grantee $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Sets the owner.
     *
     * @return Account
     */
    public function getOwner(): Account
    {
        return $this->owner;
    }

    /**
     * Sets the owner.
     *
     * @param  Account $owner
     * @return self
     */
    public function setOwner(Account $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetShareInfoEnvelope(
            new GetShareInfoBody($this)
        );
    }
}
