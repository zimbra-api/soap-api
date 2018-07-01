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
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * TzFixupRuleMatchRules struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="rules")
 */
class TzFixupRuleMatchRules
{
    /**
     * @Accessor(getter="getStandard", setter="setStandard")
     * @SerializedName("standard")
     * @Type("Zimbra\Admin\Struct\TzFixupRuleMatchRule")
     * @XmlElement
     */
    private $_standard;

    /**
     * @Accessor(getter="getDaylight", setter="setDaylight")
     * @SerializedName("daylight")
     * @Type("Zimbra\Admin\Struct\TzFixupRuleMatchRule")
     * @XmlElement
     */
    private $_daylight;

    /**
     * @Accessor(getter="getStdOffset", setter="setStdOffset")
     * @SerializedName("stdoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_stdOffset;

    /**
     * @Accessor(getter="getDstOffset", setter="setDstOffset")
     * @SerializedName("dayoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_dstOffset;

    /**
     * Constructor method for TzFixupRuleMatchRules
     * @param TzFixupRuleMatchRule $standard Standard match rule
     * @param TzFixupRuleMatchRule $daylight Daylight saving match rule
     * @param int $stdoff Offset from UTC in standard time; local = UTC + offset
     * @param int $dayoff Offset from UTC in daylight time; present only if DST is used
     * @return self
     */
    public function __construct(
        TzFixupRuleMatchRule $standard,
        TzFixupRuleMatchRule $daylight,
        $stdoff,
        $dayoff
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
    public function getStandard()
    {
        return $this->_standard;
    }

    /**
     * Sets the standard match date.
     *
     * @param  TzFixupRuleMatchRule $standard
     * @return self
     */
    public function setStandard(TzFixupRuleMatchRule $standard)
    {
        $this->_standard = $standard;
        return $this;
    }

    /**
     * Gets the daylight match date.
     *
     * @return TzFixupRuleMatchRule
     */
    public function getDaylight()
    {
        return $this->_daylight;
    }

    /**
     * Sets the daylight match date.
     *
     * @param  TzFixupRuleMatchRule $daylight
     * @return self
     */
    public function setDaylight(TzFixupRuleMatchRule $daylight)
    {
        $this->_daylight = $daylight;
        return $this;
    }

    /**
     * Gets the stdoff
     *
     * @return int
     */
    public function getStdOffset()
    {
        return $this->_stdOffset;
    }

    /**
     * Sets the stdoff
     *
     * @param  int $stdoff
     * @return self
     */
    public function setStdOffset($stdoff)
    {
        $this->_stdOffset = (int) $stdoff;
        return $this;
    }

    /**
     * Gets the dayoff
     *
     * @return int
     */
    public function getDstOffset()
    {
        return $this->_dstOffset;
    }

    /**
     * Sets the dayoff
     *
     * @param  int $dayoff
     * @return self
     */
    public function setDstOffset($dayoff)
    {
        $this->_dstOffset = (int) $dayoff;
        return $this;
    }
}