<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * TimeAttr struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="attr")
 */
class TimeAttr
{
    /**
     * @Accessor(getter="getTime", setter="setTime")
     * @SerializedName("time")
     * @Type("string")
     * @XmlAttribute
     */
    private $_time;

    /**
     * Constructor method for TimeAttr
     * @param  string $time end time
     * @return self
     */
    public function __construct($time)
    {
        $this->setTime($time);
    }

    /**
     * Gets end time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->_time;
    }

    /**
     * Sets end time
     *
     * @param  string $time
     * @return self
     */
    public function setTime($time)
    {
        $this->_time = trim($time);
        return $this;
    }
}
