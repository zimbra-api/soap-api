<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * DistributionListInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListInfo extends ObjectInfo
{
    /**
     * Flags whether user is the owner of the group.
     * Only returned if ownerOf on the request is 1 (true)
     * 
     * @var bool
     */
    #[Accessor(getter: 'isOwner', setter: 'setIsOwner')]
    #[SerializedName('isOwner')]
    #[Type('bool')]
    #[XmlAttribute]
    private $isOwner;

    /**
     * Flags whether user is a member of the group.
     * Only returned if memberOf on the request is 1 (true)
     * 
     * @var bool
     */
    #[Accessor(getter: 'isMember', setter: 'setIsMember')]
    #[SerializedName('isMember')]
    #[Type('bool')]
    #[XmlAttribute]
    private $isMember;

    /**
     * Flags whether the group is dynamic or not
     * 
     * @var bool
     */
    #[Accessor(getter: 'isDynamic', setter: 'setDynamic')]
    #[SerializedName('dynamic')]
    #[Type('bool')]
    #[XmlAttribute]
    private $dynamic;

    /**
     * Group members
     * 
     * @var array
     */
    #[Accessor(getter: 'getMembers', setter: 'setMembers')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'dlm', namespace: 'urn:zimbraAccount')]
    private $members = [];

    /**
     * Group owners
     * 
     * @var array
     */
    #[Accessor(getter: 'getOwners', setter: 'setOwners')]
    #[SerializedName('owners')]
    #[Type('array<Zimbra\Account\Struct\DistributionListGranteeInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    #[XmlList(inline: false, entry: 'owner', namespace: 'urn:zimbraAccount')]
    private $owners = [];

    /**
     * Rights
     * 
     * @var array
     */
    #[Accessor(getter: 'getRights', setter: 'setRights')]
    #[SerializedName('rights')]
    #[Type('array<Zimbra\Account\Struct\DistributionListRightInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    #[XmlList(inline: false, entry: 'right', namespace: 'urn:zimbraAccount')]
    private $rights = [];

    /**
     * Constructor
     * 
     * @param string $name
     * @param string $id
     * @param array  $attrs
     * @param array  $members
     * @param array  $owners
     * @param array  $rights
     * @param bool   $isOwner
     * @param bool   $isMember
     * @param bool   $dynamic
     * @return self
     */
    public function __construct(
        string $name = '',
        string $id = '',
        array $attrs = [],
        array $members = [],
        array $owners = [],
        array $rights = [],
        ?bool $isOwner = null,
        ?bool $isMember = null,
        ?bool $dynamic = null
    )
    {
        parent::__construct($name, $id, $attrs);
        $this->setMembers($members)
             ->setOwners($owners)
             ->setRights($rights);
        if (null !== $isOwner) {
            $this->setIsOwner($isOwner);
        }
        if (null !== $isMember) {
            $this->setIsMember($isMember);
        }
        if (null !== $dynamic) {
            $this->setDynamic($dynamic);
        }
    }

    /**
     * Get isOwner
     *
     * @return bool
     */
    public function isOwner(): ?bool
    {
        return $this->isOwner;
    }

    /**
     * Set isOwner
     *
     * @param  bool $isOwner
     * @return self
     */
    public function setIsOwner(bool $isOwner): self
    {
        $this->isOwner = $isOwner;
        return $this;
    }

    /**
     * Get isMember
     *
     * @return bool
     */
    public function isMember(): ?bool
    {
        return $this->isMember;
    }

    /**
     * Set isMember
     *
     * @param  bool $isMember
     * @return self
     */
    public function setIsMember(bool $isMember): self
    {
        $this->isMember = $isMember;
        return $this;
    }

    /**
     * Get is dynamic
     *
     * @return bool
     */
    public function isDynamic(): ?bool
    {
        return $this->dynamic;
    }

    /**
     * Set is dynamic
     *
     * @param  bool $dynamic
     * @return self
     */
    public function setDynamic(bool $dynamic): self
    {
        $this->dynamic = $dynamic;
        return $this;
    }

    /**
     * Get members
     *
     * @return array
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set members
     *
     * @param  array $members
     * @return self
     */
    public function setMembers(array $members)
    {
        $this->members = array_unique(
            array_map(static fn ($member) => trim($member), $members)
        );
        return $this;
    }

    /**
     * Get owners
     *
     * @return array
     */
    public function getOwners()
    {
        return $this->owners;
    }

    /**
     * Set owners
     *
     * @param  array $owners
     * @return self
     */
    public function setOwners(array $owners)
    {
        $this->owners = array_filter(
            $owners, static fn ($owner) => $owner instanceof DistributionListGranteeInfo
        );
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->rights = array_filter(
            $rights, static fn ($right) => $right instanceof DistributionListRightInfo
        );
        return $this;
    }
}
