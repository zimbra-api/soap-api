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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\AttributeDescription;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAttributeInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAttributeInfoResponse extends SoapResponse
{
    /**
     * Attribute descriptions
     * 
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @Type("array<Zimbra\Admin\Struct\AttributeDescription>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAdmin")
     */
    private $attrs = [];

    /**
     * Constructor
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
     * Set attribute descriptions
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
     * Get attribute descriptions
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }
}
