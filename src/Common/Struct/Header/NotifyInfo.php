<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct\Header;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * NotifyInfo struct class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NotifyInfo
{
    /**
     * @Accessor(getter="getSequenceNum", setter="setSequenceNum")
     * @SerializedName("seq")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getSequenceNum", setter: "setSequenceNum")]
    #[SerializedName("seq")]
    #[Type("int")]
    #[XmlAttribute]
    private $sequenceNum;

    /**
     * Constructor
     *
     * @param int $sequenceNum
     * @return self
     */
    public function __construct(?int $sequenceNum = null)
    {
        if (null !== $sequenceNum) {
            $this->setSequenceNum($sequenceNum);
        }
    }

    /**
     * Get sequence number for the highest notification received
     *
     * @return int
     */
    public function getSequenceNum(): ?int
    {
        return $this->sequenceNum;
    }

    /**
     * Set sequence number for the highest notification received
     *
     * @param  int $sequenceNum
     * @return self
     */
    public function setSequenceNum(int $sequenceNum): self
    {
        $this->sequenceNum = $sequenceNum;
        return $this;
    }
}
