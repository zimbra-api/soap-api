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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * AdminAttrsImplTrait trait
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
trait AdminAttrsImplTrait
{
    /**
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @Type("array<Zimbra\Admin\Struct\Attr>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getAttrs", setter: "setAttrs")]
    #[Type("array<Zimbra\Admin\Struct\Attr>")]
    #[XmlList(inline: true, entry: "a", namespace: "urn:zimbraAdmin")]
    private $attrs = [];

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Set attribute sequence
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter(
            $attrs,
            static fn($attr) => $attr instanceof Attr
        );
        return $this;
    }

    /**
     * Get attribute sequence
     *
     * @return array
     */
    public function getAttrs(): ?array
    {
        return $this->attrs;
    }
}
