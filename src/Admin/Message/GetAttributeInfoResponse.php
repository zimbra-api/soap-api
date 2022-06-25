<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyattr and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\AttributeDescription;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAttributeInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAttributeInfoResponse implements ResponseInterface
{
    /**
     * Attribute descriptions
     * 
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Admin\Struct\AttributeDescription>")
     * @XmlList(inline=true, entry="a")
     */
    private $attrs = [];

    /**
     * Constructor method for GetAttributeInfoResponse
     *
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = [])
    {
        $this->setAttrs($attrs);
    }

    /**
     * Add an attribute description
     *
     * @param  AttributeDescription $attr
     * @return self
     */
    public function addAttr(AttributeDescription $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Sets attribute descriptions
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter($attrs, static fn ($attr) => $attr instanceof AttributeDescription);
        return $this;
    }

    /**
     * Gets attribute descriptions
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }
}
