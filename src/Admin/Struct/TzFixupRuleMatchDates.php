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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * TzFixupRuleMatchDates struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="dates")
 */
class TzFixupRuleMatchDates
{
    /**
     * Standard match date
     * @Accessor(getter="getStandard", setter="setStandard")
     * @SerializedName("standard")
     * @Type("Zimbra\Admin\Struct\TZFixupRuleMatchDate")
     * @XmlElement
     */
    private $standard;

    /**
     * Daylight saving match date
     * @Accessor(getter="getDaylight", setter="setDaylight")
     * @SerializedName("daylight")
     * @Type("Zimbra\Admin\Struct\TZFixupRuleMatchDate")
     * @XmlElement
     */
    private $daylight;

    /**
     * Offset from UTC in standard time; local = UTC + offset
     * @Accessor(getter="getStdOffset", setter="setStdOffset")
     * @SerializedName("stdoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $stdOffset;

    /**
     * Offset from UTC in daylight time; present only if DST is used
     * @Accessor(getter="getDstOffset", setter="setDstOffset")
     * @SerializedName("dayoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $dstOffset;

    /**
     * Constructor method for TzFixupRuleMatchDates
     * @param TzFixupRuleMatchDate $standard
     * @param TzFixupRuleMatchDate $daylight
     * @param int $stdoff
     * @param int $dayoff
     * @return self
     */
    public function __construct(
        TzFixupRuleMatchDate $standard,
        TzFixupRuleMatchDate $daylight,
        int $stdoff,
        int $dayoff
    )
    {
        $this->setStandard($standard)
             ->setDaylight($daylight)
             ->setStdOffset($stdoff)
             ->setDstOffset($dayoff);
    }

    /**
     * Gets the standard match date.
     *
     * @return TzFixupRuleMatchDate
     */
    public function getStandard(): TzFixupRuleMatchDate
    {
        return $this->standard;
    }

    /**
     * Sets the standard match date.
     *
     * @param  TzFixupRuleMatchDate $standard
     * @return self
     */
    public function setStandard(TzFixupRuleMatchDate $standard): self
    {
        $this->standard = $standard;
        return $this;
    }

    /**
     * Gets the daylight match date.
     *
     * @return TzFixupRuleMatchDate
     */
    public function getDaylight(): TzFixupRuleMatchDate
    {
        return $this->daylight;
    }

    /**
     * Sets the daylight match date.
     *
     * @param  TzFixupRuleMatchDate $daylight
     * @return self
     */
    public function setDaylight(TzFixupRuleMatchDate $daylight): self
    {
        $this->daylight = $daylight;
        return $this;
    }

    /**
     * Gets the stdoff
     *
     * @return int
     */
    public function getStdOffset(): int
    {
        return $this->stdOffset;
    }

    /**
     * Sets the stdoff
     *
     * @param  int $stdoff
     * @return self
     */
    public function setStdOffset(int $stdoff): self
    {
        $this->stdOffset = $stdoff;
        return $this;
    }

    /**
     * Gets the dayoff
     *
     * @return int
     */
    public function getDstOffset(): int
    {
        return $this->dstOffset;
    }

    /**
     * Sets the dayoff
     *
     * @param  int $dayoff
     * @return self
     */
    public function setDstOffset(int $dayoff): self
    {
        $this->dstOffset = $dayoff;
        return $this;
    }
}