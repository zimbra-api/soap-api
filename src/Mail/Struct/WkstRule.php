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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\WeekDay;
use Zimbra\Common\Struct\WkstRuleInterface;

/**
 * WkstRule class
 * Week-start rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class WkstRule implements WkstRuleInterface
{
    /**
     * Weekday -  SU|MO|TU|WE|TH|FR|SA
     * @Accessor(getter="getDay", setter="setDay")
     * @SerializedName("day")
     * @Type("Enum<Zimbra\Common\Enum\WeekDay>")
     * @XmlAttribute
     */
    private WeekDay $day;

    /**
     * Constructor method for WkstRule
     *
     * @param  WeekDay $day
     * @return self
     */
    public function __construct(WeekDay $day)
    {
        $this->setDay($day);
    }

    /**
     * Get day
     *
     * @return WeekDay
     */
    public function getDay(): WeekDay
    {
        return $this->day;
    }

    /**
     * Set day
     *
     * @param  WeekDay $day
     * @return self
     */
    public function setDay(WeekDay $day): self
    {
        $this->day = $day;
        return $this;
    }
}
