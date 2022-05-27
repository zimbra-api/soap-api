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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};

/**
 * EffectiveRightsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class EffectiveRightsInfo
{
    /**
     * Rights
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("right")
     * @Type("array<Zimbra\Admin\Struct\RightWithName>")
     * @XmlList(inline = true, entry = "right")
     */
    private $rights = [];

    /**
     * All attributes that can be set
     * @Accessor(getter="getSetAttrs", setter="setSetAttrs")
     * @SerializedName("setAttrs")
     * @Type("Zimbra\Admin\Struct\EffectiveAttrsInfo")
     * @XmlElement
     */
    private EffectiveAttrsInfo $setAttrs;

    /**
     * All attributes that can be got
     * @Accessor(getter="getGetAttrs", setter="setGetAttrs")
     * @SerializedName("getAttrs")
     * @Type("Zimbra\Admin\Struct\EffectiveAttrsInfo")
     * @XmlElement
     */
    private EffectiveAttrsInfo $getAttrs;

    /**
     * Constructor method for EffectiveRightsInfo
     * @param EffectiveAttrsInfo $setAttrs
     * @param EffectiveAttrsInfo $getAttrs
     * @param array $rights
     * @return self
     */
    public function __construct(EffectiveAttrsInfo $setAttrs, EffectiveAttrsInfo $getAttrs, array $rights = [])
    {
        $this->setSetAttrs($setAttrs)
             ->setGetAttrs($getAttrs)
             ->setRights($rights);
    }
    /**
     * Gets rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * Sets rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = [];
        foreach ($rights as $right) {
            if ($right instanceof RightWithName) {
                $this->rights[] = $right;
            }
        }
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
     * Gets setAttrs
     *
     * @return EffectiveAttrsInfo
     */
    public function getSetAttrs(): EffectiveAttrsInfo
    {
        return $this->setAttrs;
    }

    /**
     * Sets setAttrs
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
     * Gets getAttrs
     *
     * @return EffectiveAttrsInfo
     */
    public function getGetAttrs(): EffectiveAttrsInfo
    {
        return $this->getAttrs;
    }

    /**
     * Sets getAttrs
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
