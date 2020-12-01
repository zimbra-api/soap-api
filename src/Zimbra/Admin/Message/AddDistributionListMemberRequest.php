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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Soap\Request;

/**
 * AddDistributionListMemberRequest request class
 * Adding members to a distribution list
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AddDistributionListMemberRequest")
 */
class AddDistributionListMemberRequest extends Request
{
    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Members
     * 
     * @Accessor(getter="getMembers", setter="setMembers")
     * @SerializedName("dlm")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "dlm")
     */
    private $members;

    /**
     * Constructor method for AddDistributionListMemberRequest
     * @param  string $id
     * @param  array  $members
     * @return self
     */
    public function __construct(string $id, array $members)
    {
        $this->setId($id)
             ->setMembers($members);
    }

    /**
     * Gets zimbra id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets zimbra id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Add a dl member
     *
     * @param  string $member
     * @return self
     */
    public function addMember(string $member): self
    {
        $member = trim($member);
        if (!empty($member) && !in_array($member, $this->members)) {
            $this->members[] = $member;
        }
        return $this;
    }

    /**
     * Sets member sequence
     *
     * @param  array $members Members
     * @return self
     */
    public function setMembers(array $members): self
    {
        $this->members = [];
        foreach ($members as $member) {
            $this->addMember($member);
        }
        return $this;
    }

    /**
     * Gets member sequence
     *
     * @return array
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AddDistributionListMemberEnvelope)) {
            $this->envelope = new AddDistributionListMemberEnvelope(
                new AddDistributionListMemberBody($this)
            );
        }
    }
}
