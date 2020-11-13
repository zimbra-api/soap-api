<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * TimeAttr struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $time;

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
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * Sets end time
     *
     * @param  string $time
     * @return self
     */
    public function setTime($time): self
    {
        $this->time = trim($time);
        return $this;
    }
}
