<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * NotifyInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="notify")
 */
class NotifyInfo
{
    /**
     * @Accessor(getter="getSequenceNum", setter="setSequenceNum")
     * @SerializedName("seq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_sequenceNum;

    /**
     * Constructor method for NotifyInfo
     * @param integer $sequenceNum
     * @return self
     */
    public function __construct(
        $sequenceNum = null
    )
    {
        if(null !== $sequenceNum)
        {
            $this->setSequenceNum($sequenceNum);
        }
    }

    /**
     * Gets sequence number for the highest notification received
     *
     * @return string
     */
    public function getSequenceNum()
    {
        return $this->_sequenceNum;
    }

    /**
     * Sets sequence number for the highest notification received
     *
     * @param  int $sequenceNum
     * @return self
     */
    public function setSequenceNum($sequenceNum)
    {
        $this->_sequenceNum = (int) $sequenceNum;
        return $this;
    }
}
