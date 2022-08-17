<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ClientInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ClientInfoResponse extends SoapResponse
{
    /**
     * Attributes
     * 
     * @Accessor(getter="getAttrList", setter="setAttrList")
     * @Type("array<Zimbra\Admin\Struct\Attr>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttrList', setter: 'setAttrList')]
    #[Type(name: 'array<Zimbra\Admin\Struct\Attr>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraAccount')]
    private $attrList = [];

    /**
     * Constructor
     * 
     * @param  array $attrList
     * @return self
     */
    public function __construct(array $attrList = [])
    {
        $this->setAttrList($attrList);
    }

    /**
     * Set attrList
     *
     * @param  array $attrList
     * @return self
     */
    public function setAttrList(array $attrList): self
    {
        $this->attrList = array_filter($attrList, static fn ($attr) => $attr instanceof Attr);
        return $this;
    }

    /**
     * Get attrList
     *
     * @return array
     */
    public function getAttrList(): array
    {
        return $this->attrList;
    }
}
