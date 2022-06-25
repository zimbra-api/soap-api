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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * TzFixupRuleMatchRules struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class TzFixupRuleMatchRules
{
    /**
     * Standard match rule
     * @Accessor(getter="getStandard", setter="setStandard")
     * @SerializedName("standard")
     * @Type("Zimbra\Admin\Struct\TzFixupRuleMatchRule")
     * @XmlElement
     */
    private TzFixupRuleMatchRule $standard;

    /**
     * Daylight saving match rule
     * @Accessor(getter="getDaylight", setter="setDaylight")
     * @SerializedName("daylight")
     * @Type("Zimbra\Admin\Struct\TzFixupRuleMatchRule")
     * @XmlElement
     */
    private TzFixupRuleMatchRule $daylight;

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
     * Constructor method for TzFixupRuleMatchRules
     * @param TzFixupRuleMatchRule $standard
     * @param TzFixupRuleMatchRule $daylight
     * @param int $stdoff
     * @param int $dayoff
     * @return self
     */
    public function __construct(
        TzFixupRuleMatchRule $standard,
        TzFixupRuleMatchRule $daylight,
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
     * @return TzFixupRuleMatchRule
     */
    public function getStandard(): TzFixupRuleMatchRule
    {
        return $this->standard;
    }

    /**
     * Sets the standard match date.
     *
     * @param  TzFixupRuleMatchRule $standard
     * @return self
     */
    public function setStandard(TzFixupRuleMatchRule $standard): self
    {
        $this->standard = $standard;
        return $this;
    }

    /**
     * Gets the daylight match date.
     *
     * @return TzFixupRuleMatchRule
     */
    public function getDaylight(): TzFixupRuleMatchRule
    {
        return $this->daylight;
    }

    /**
     * Sets the daylight match date.
     *
     * @param  TzFixupRuleMatchRule $daylight
     * @return self
     */
    public function setDaylight(TzFixupRuleMatchRule $daylight): self
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