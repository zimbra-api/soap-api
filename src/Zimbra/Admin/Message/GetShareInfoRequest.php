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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector as Account;
use Zimbra\Struct\GranteeChooser as Grantee;

/**
 * GetShareInfoRequest request class
 * Iterate through all folders of the owner's mailbox and return shares that match grantees specified by the <grantee> specifier. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetShareInfoRequest")
 */
class GetShareInfoRequest extends Request
{
    /**
     * Grantee
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Struct\GranteeChooser")
     * @XmlElement
     */
    private $grantee;

    /**
     * Owner
     * @Accessor(getter="getOwner", setter="setOwner")
     * @SerializedName("owner")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $owner;

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
    public function getGrantee(): Grantee
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
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetShareInfoEnvelope)) {
            $this->envelope = new GetShareInfoEnvelope(
                new GetShareInfoBody($this)
            );
        }
    }
}
