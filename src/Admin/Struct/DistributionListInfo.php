<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * DistributionListInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListInfo extends AdminObjectInfo
{
    /**
     * Flags whether this is a dynamic distribution list or not
     * 
     * @var bool
     */
    #[Accessor(getter: 'isDynamic', setter: 'setDynamic')]
    #[SerializedName('dynamic')]
    #[Type('bool')]
    #[XmlAttribute]
    private $dynamic;

    /**
     * dl members
     * 
     * @var array
     */
    #[Accessor(getter: 'getMembers', setter: 'setMembers')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'dlm', namespace: 'urn:zimbraAdmin')]
    private $members = [];

    /**
     * Owner information
     * 
     * @var array
     */
    #[Accessor(getter: 'getOwners', setter: 'setOwners')]
    #[SerializedName('owners')]
    #[Type('array<Zimbra\Admin\Struct\GranteeInfo>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'owner', namespace: 'urn:zimbraAdmin')]
    private $owners = [];

    /**
     * Constructor
     * 
     * @param string $name
     * @param string $id
     * @param array  $members
     * @param array  $attrs
     * @param array  $owners
     * @param bool   $dynamic
     * @return self
     */
    public function __construct(
        string $name = '',
        string $id = '',
        array $members = [],
        array $attrs = [],
        array $owners = [],
        ?bool $dynamic = NULL
    )
    {
        parent::__construct($name, $id, $attrs);
        $this->setMembers($members)
             ->setOwners($owners);
        if (NULL !== $dynamic) {
            $this->setDynamic($dynamic);
        }
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
        $this->members = array_unique(array_map(static fn ($member) => trim($member), $members));
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
        $this->owners = array_filter($owners, static fn ($owner) => $owner instanceof GranteeInfo);
        return $this;
    }
}
