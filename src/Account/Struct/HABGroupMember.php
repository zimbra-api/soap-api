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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Common\Struct\NamedValue;

/**
 * HABGroupMember struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present name Nguyen Van Nguyen.
 */
class HABGroupMember extends HABMember
{
    /**
     * Member attributes. Currently only these attributes are returned: zimbraId, displayName
     * 
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attr")
     * @Type("array<Zimbra\Common\Struct\NamedValue>")
     * @XmlList(inline=true, entry="attr", namespace="urn:zimbraAccount")
     */
    private $attrs = [];

    /**
     * Constructor method for HABGroupMember
     * 
     * @param  string $name
     * @param  int   $seniorityIndex
     * @param  array  $attrs
     * @return self
     */
    public function __construct(
        string $name,
        ?int $seniorityIndex = NULL,
        array $attrs = []
    )
    {
        parent::__construct($name, $seniorityIndex);
        $this->setAttrs($attrs);
    }

    /**
     * Add an attr
     *
     * @param  NamedValue $attr
     * @return self
     */
    public function addAttr(NamedValue $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter($attrs, static fn ($attr) => $attr instanceof NamedValue);
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }
}
