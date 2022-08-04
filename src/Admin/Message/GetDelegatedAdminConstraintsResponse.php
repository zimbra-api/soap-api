<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetDelegatedAdminConstraintsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDelegatedAdminConstraintsResponse extends SoapResponse
{
    /**
     * Constraint attributes
     * 
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @Type("array<Zimbra\Admin\Struct\ConstraintAttr>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAdmin")
     */
    private $attrs = [];

    /**
     * Constructor method for GetDelegatedAdminConstraintsResponse
     *
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = [])
    {
        $this->setAttrs($attrs);
    }

    /**
     * Add a constraint attribute
     *
     * @param  ConstraintAttr $attr
     * @return self
     */
    public function addAttr(ConstraintAttr $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Set constraint attributes
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter($attrs, static fn ($attr) => $attr instanceof ConstraintAttr);
        return $this;
    }

    /**
     * Get constraint attributes
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }
}
