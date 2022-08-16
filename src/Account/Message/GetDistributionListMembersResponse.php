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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetDistributionListMembersResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDistributionListMembersResponse extends SoapResponse
{
    /**
     * 1 (true) if more members left to return
     * Only present if the list of members is given
     * 
     * @var bool
     */
    #[Accessor(getter: 'getMore', setter: 'setMore')]
    #[SerializedName(name: 'more')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $more;

    /**
     * total number of distribution lists (not affected by limit/offset)
     * 
     * @var int
     */
    #[Accessor(getter: 'getTotal', setter: 'setTotal')]
    #[SerializedName(name: 'total')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $total;

    /**
     * Distribution list members
     * 
     * @var array
     */
    #[Accessor(getter: 'getDlMembers', setter: 'setDlMembers')]
    #[Type(name: 'array<string>')]
    #[XmlList(inline: true, entry: 'dlm', namespace: 'urn:zimbraAccount')]
    private $dlMembers = [];

    /**
     * HAB Group members
     * 
     * @var array
     */
    #[Accessor(getter: 'getHABGroupMembers', setter: 'setHABGroupMembers')]
    #[SerializedName(name: 'groupMembers')]
    #[Type(name: 'array<Zimbra\Account\Struct\HABGroupMember>')]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    #[XmlList(inline: false, entry: 'groupMember', namespace: 'urn:zimbraAccount')]
    private $habGroupMembers = [];

    /**
     * Constructor
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
     * Get more
     *
     * @return bool
     */
    public function getMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Set more
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
     * Get total
     *
     * @return int
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * Set total
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
     * Get dlMembers
     *
     * @return array
     */
    public function getDlMembers(): array
    {
        return $this->dlMembers;
    }

    /**
     * Set dlMembers
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
     * Set habGroupMembers
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
     * Get habGroupMembers
     *
     * @return array
     */
    public function getHABGroupMembers(): array
    {
        return $this->habGroupMembers;
    }
}
