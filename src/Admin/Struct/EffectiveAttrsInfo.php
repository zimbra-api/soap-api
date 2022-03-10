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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * EffectiveAttrsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class EffectiveAttrsInfo
{
    /**
     * Flags whether all attributes on the target entry are accessible.
     * if set, no <a> elements will appear under the <setAttrs>/<getAttrs>
     * @Accessor(getter="getAll", setter="setAll")
     * @SerializedName("all")
     * @Type("bool")
     * @XmlAttribute
     */
    private $all;

    /**
     * Attributes
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Admin\Struct\EffectiveAttrInfo>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attrs;

    /**
     * Constructor method for EffectiveAttrsInfo
     * @param bool $all
     * @param array $attrs
     * @return self
     */
    public function __construct(?bool $all = NULL, array $attrs = [])
    {
        if (NULL !== $all) {
            $this->setAll($all);
        }
        $this->setAttrs($attrs);
    }

    /**
     * Gets all
     *
     * @return bool
     */
    public function getAll(): ?bool
    {
        return $this->all;
    }

    /**
     * Sets all
     *
     * @param  bool $all
     * @return self
     */
    public function setAll(bool $all): self
    {
        $this->all = $all;
        return $this;
    }

    /**
     * Gets attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Sets attrs
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof EffectiveAttrInfo) {
                $this->attrs[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Adds an attr
     *
     * @param  EffectiveAttrInfo $attr
     * @return self
     */
    public function addAttr(EffectiveAttrInfo $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }
}
