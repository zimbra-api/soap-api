<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

use Zimbra\Struct\NumAttrInterface;

/**
 * NumAttr class
 * Number attribute
 *
 * @package   Zimbra
 * @subpackage Mail
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="attr")
 */
class NumAttr implements NumAttrInterface
{
    /**
     * Number
     * @Accessor(getter="getNum", setter="setNum")
     * @SerializedName("num")
     * @Type("integer")
     * @XmlAttribute
     */
    private $num;

    /**
     * Constructor method for NumAttr
     *
     * @param  int $num
     * @return self
     */
    public function __construct(int $num)
    {
        $this->setNum($num);
    }

    /**
     * Gets num
     *
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * Sets num
     *
     * @param  int $num
     * @return self
     */
    public function setNum(int $num): self
    {
        $this->num = $num;
        return $this;
    }
}
