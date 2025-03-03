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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlList
};

/**
 * EffectiveRightsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EffectiveRightsInfo
{
    /**
     * Rights
     *
     * @var array
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[Type("array<Zimbra\Admin\Struct\RightWithName>")]
    #[XmlList(inline: true, entry: "right", namespace: "urn:zimbraAdmin")]
    private array $rights = [];

    /**
     * All attributes that can be set
     *
     * @var EffectiveAttrsInfo
     */
    #[Accessor(getter: "getSetAttrs", setter: "setSetAttrs")]
    #[SerializedName("setAttrs")]
    #[Type(EffectiveAttrsInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private EffectiveAttrsInfo $setAttrs;

    /**
     * All attributes that can be got
     *
     * @var EffectiveAttrsInfo
     */
    #[Accessor(getter: "getGetAttrs", setter: "setGetAttrs")]
    #[SerializedName("getAttrs")]
    #[Type(EffectiveAttrsInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private EffectiveAttrsInfo $getAttrs;

    /**
     * Constructor
     *
     * @param EffectiveAttrsInfo $setAttrs
     * @param EffectiveAttrsInfo $getAttrs
     * @param array $rights
     * @return self
     */
    public function __construct(
        EffectiveAttrsInfo $setAttrs,
        EffectiveAttrsInfo $getAttrs,
        array $rights = []
    ) {
        $this->setSetAttrs($setAttrs)
            ->setGetAttrs($getAttrs)
            ->setRights($rights);
    }
    /**
     * Get rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_filter(
            $rights,
            static fn($right) => $right instanceof RightWithName
        );
        return $this;
    }

    /**
     * Adds a right
     *
     * @param  RightWithName $right
     * @return self
     */
    public function addRight(RightWithName $right): self
    {
        $this->rights[] = $right;
        return $this;
    }

    /**
     * Get setAttrs
     *
     * @return EffectiveAttrsInfo
     */
    public function getSetAttrs(): EffectiveAttrsInfo
    {
        return $this->setAttrs;
    }

    /**
     * Set setAttrs
     *
     * @param  EffectiveAttrsInfo $setAttrs
     * @return self
     */
    public function setSetAttrs(EffectiveAttrsInfo $setAttrs): self
    {
        $this->setAttrs = $setAttrs;
        return $this;
    }

    /**
     * Get getAttrs
     *
     * @return EffectiveAttrsInfo
     */
    public function getGetAttrs(): EffectiveAttrsInfo
    {
        return $this->getAttrs;
    }

    /**
     * Set getAttrs
     *
     * @param  EffectiveAttrsInfo $getAttrs
     * @return self
     */
    public function setGetAttrs(EffectiveAttrsInfo $getAttrs): self
    {
        $this->getAttrs = $getAttrs;
        return $this;
    }
}
