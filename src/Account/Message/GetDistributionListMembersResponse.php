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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Account\Struct\HABGroupMember;
use Zimbra\Soap\ResponseInterface;

/**
 * GetDistributionListMembersResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetDistributionListMembersResponse implements ResponseInterface
{
    /**
     * 1 (true) if more members left to return
     * Only present if the list of members is given
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * total number of distribution lists (not affected by limit/offset)
     * @Accessor(getter="getTotal", setter="setTotal")
     * @SerializedName("total")
     * @Type("integer")
     * @XmlAttribute
     */
    private $total;

    /**
     * Distribution list members
     * @Accessor(getter="getDlMembers", setter="setDlMembers")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="dlm", namespace="urn:zimbraAccount")
     */
    private $dlMembers = [];

    /**
     * HAB Group members
     * 
     * @Accessor(getter="getHABGroupMembers", setter="setHABGroupMembers")
     * @SerializedName("groupMembers")
     * @Type("array<Zimbra\Account\Struct\HABGroupMember>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="groupMember", namespace="urn:zimbraAccount")
     */
    private $habGroupMembers = [];

    /**
     * Constructor method for GetDistributionListMembersResponse
     *
     * @param array $dlMembers
     * @param array $habGroupMembers
     * @param bool $more
     * @param int $total
     * @return self
     */
    public function __construct(
        array $dlMembers = [],
        array $habGroupMembers = [],
        ?bool $more = NULL,
        ?int $total = NULL
    )
    {
        $this->setDlMembers($dlMembers)
             ->setHABGroupMembers($habGroupMembers);
        if (NULL !== $more) {
            $this->setMore($more);
        }
        if (NULL !== $total) {
            $this->setTotal($total);
        }
    }

    /**
     * Gets more
     *
     * @return bool
     */
    public function getMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Sets more
     *
     * @param  bool $more
     * @return self
     */
    public function setMore(bool $more): self
    {
        $this->more = $more;
        return $this;
    }

    /**
     * Gets total
     *
     * @return int
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * Sets total
     *
     * @param  int $total
     * @return self
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * Gets dlMembers
     *
     * @return array
     */
    public function getDlMembers(): array
    {
        return $this->dlMembers;
    }

    /**
     * Sets dlMembers
     *
     * @param  array $members
     * @return self
     */
    public function setDlMembers(array $members): self
    {
        $this->dlMembers = array_unique(array_map(static fn ($member) => trim($member), $members));
        return $this;
    }

    /**
     * add dlMember
     *
     * @param  string $member
     * @return self
     */
    public function addDlMember(string $member): self
    {
        $dlMember = trim($member);
        if (!empty($dlMember) && !in_array($dlMember, $this->dlMembers)) {
            $this->dlMembers[] = $dlMember;
        }
        return $this;
    }

    /**
     * Add habGroupMember
     *
     * @param  HABGroupMember $habGroupMember
     * @return self
     */
    public function addHABGroupMember(HABGroupMember $habGroupMember): self
    {
        $this->habGroupMembers[] = $habGroupMember;
        return $this;
    }

    /**
     * Sets habGroupMembers
     *
     * @param  array $members
     * @return self
     */
    public function setHABGroupMembers(array $members): self
    {
        $this->habGroupMembers = array_filter($members, static fn ($member) => $member instanceof HABGroupMember);
        return $this;
    }

    /**
     * Gets habGroupMembers
     *
     * @return array
     */
    public function getHABGroupMembers(): array
    {
        return $this->habGroupMembers;
    }
}
