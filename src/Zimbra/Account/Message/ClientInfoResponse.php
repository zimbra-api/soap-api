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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\Attr;
use Zimbra\Soap\ResponseInterface;

/**
 * ClientInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ClientInfoResponse")
 */
class ClientInfoResponse implements ResponseInterface
{
    /**
     * Attributes
     * @Accessor(getter="getAttrList", setter="setAttrList")
     * @SerializedName("a")
     * @Type("array<Zimbra\Admin\Struct\Attr>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attrList;

    /**
     * Constructor method for ClientInfoResponse
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
     * @param  array $requests
     * @return self
     */
    public function setAttrList(array $attrList): self
    {
        $this->attrList = [];
        foreach ($attrList as $attr) {
            if ($attr instanceof Attr) {
                $this->attrList[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attrList
     *
     * @return array
     */
    public function getAttrList(): array
    {
        return $this->attrList;
    }
}
