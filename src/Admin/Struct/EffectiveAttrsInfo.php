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
    XmlAttribute,
    XmlList
};

/**
 * EffectiveAttrsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EffectiveAttrsInfo
{
    /**
     * Flags whether all attributes on the target entry are accessible.
     * if set, no <a> elements will appear under the <setAttrs>/<getAttrs>
     *
     * @var bool
     */
    #[Accessor(getter: "getAll", setter: "setAll")]
    #[SerializedName("all")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $all = null;

    /**
     * Attributes
     *
     * @var array
     */
    #[Accessor(getter: "getAttrs", setter: "setAttrs")]
    #[Type("array<Zimbra\Admin\Struct\EffectiveAttrInfo>")]
    #[XmlList(inline: true, entry: "a", namespace: "urn:zimbraAdmin")]
    private array $attrs = [];

    /**
     * Constructor
     *
     * @param bool $all
     * @param array $attrs
     * @return self
     */
    public function __construct(?bool $all = null, array $attrs = [])
    {
        $this->setAttrs($attrs);
        if (null !== $all) {
            $this->setAll($all);
        }
    }

    /**
     * Get all
     *
     * @return bool
     */
    public function getAll(): ?bool
    {
        return $this->all;
    }

    /**
     * Set all
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
     * Get attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Set attrs
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter(
            $attrs,
            static fn($attr) => $attr instanceof EffectiveAttrInfo
        );
        return $this;
    }
}
