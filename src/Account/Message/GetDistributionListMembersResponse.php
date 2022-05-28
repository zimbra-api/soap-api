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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
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
     * @SerializedName("dlm")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "dlm")
     */
    private $dlMembers = [];

    /**
     * HAB Group members
     * 
     * @Accessor(getter="getHABGroupMembers", setter="setHABGroupMembers")
     * @SerializedName("groupMembers")
     * @Type("array<Zimbra\Account\Struct\HABGroupMember>")
     * @XmlList(inline = false, entry = "groupMember")
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
     * @param  array $dlMembers
     * @return self
     */
    public function setDlMembers(array $dlMembers): self
    {
        $this->dlMembers = [];
        foreach ($dlMembers as $dlMember) {
            $this->addDlMember($dlMember);
        }
        return $this;
    }

    /**
     * add dlMember
     *
     * @param  string $dlMember
     * @return self
     */
    public function addDlMember(string $dlMember): self
    {
        $dlMember = trim($dlMember);
        if (!in_array($dlMember, $this->dlMembers)) {
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
     * @param  array $habGroupMembers
     * @return self
     */
    public function setHABGroupMembers(array $habGroupMembers): self
    {
        $this->habGroupMembers = [];
        foreach ($habGroupMembers as $habGroupMember) {
            if ($habGroupMember instanceof HABGroupMember) {
                $this->habGroupMembers[] = $habGroupMember;
            }
        }
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
