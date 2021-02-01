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
use Zimbra\Enum\WeekDay;
use Zimbra\Struct\WkDayInterface;

/**
 * WkDay class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="wkday")
 */
class WkDay implements WkDayInterface
{
    /**
     * Weekday -  SU|MO|TU|WE|TH|FR|SA
     * @Accessor(getter="getDay", setter="setDay")
     * @SerializedName("day")
     * @Type("Zimbra\Enum\WeekDay")
     * @XmlAttribute
     */
    private $day;

    /**
     * Week number.  [[+]|-]num: 1 to 53
     * @Accessor(getter="getOrdWk", setter="setOrdWk")
     * @SerializedName("ordwk")
     * @Type("integer")
     * @XmlAttribute
     */
    private $ordWk;

    /**
     * Constructor method for WkDay
     *
     * @param  WeekDay $day
     * @param  int $ordWk
     * @return self
     */
    public function __construct(WeekDay $day, ?int $ordWk = NULL)
    {
        $this->setDay($day);
        if (NULL !== $ordWk) {
            $this->setOrdWk($ordWk);
        }
    }

    /**
     * Gets day
     *
     * @return WeekDay
     */
    public function getDay(): WeekDay
    {
        return $this->day;
    }

    /**
     * Sets day
     *
     * @param  WeekDay $day
     * @return self
     */
    public function setDay(WeekDay $day): self
    {
        $this->day = $day;
        return $this;
    }

    /**
     * Gets ordWk
     *
     * @return int
     */
    public function getOrdWk(): ?int
    {
        return $this->ordWk;
    }

    /**
     * Sets ordWk
     *
     * @param  int $ordWk
     * @return self
     */
    public function setOrdWk(int $ordWk): self
    {
        if($ordWk != 0 && abs($ordWk) < 54) {
            $this->ordWk = $ordWk;
        }
        return $this;
    }
}
