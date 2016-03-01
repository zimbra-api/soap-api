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

use Zimbra\Struct\Base;

/**
 * TzFixupRuleMatchRules struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzFixupRuleMatchRules extends Base
{
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
        parent::__construct();
        $this->setChild('standard', $standard);
        $this->setChild('daylight', $daylight);
        $this->setProperty('stdoff', (int) $stdoff);
        $this->setProperty('dayoff', (int) $dayoff);
    }

    /**
     * Gets the standard match date.
     *
     * @return TzFixupRuleMatchRule
     */
    public function getStandard()
    {
        return $this->getChild('standard');
    }

    /**
     * Sets the standard match date.
     *
     * @param  TzFixupRuleMatchRule $standard
     * @return self
     */
    public function setStandard(TzFixupRuleMatchRule $standard)
    {
        return $this->setChild('standard', $standard);
    }

    /**
     * Gets the daylight match date.
     *
     * @return TzFixupRuleMatchRule
     */
    public function getDaylight()
    {
        return $this->getChild('daylight');
    }

    /**
     * Sets the daylight match date.
     *
     * @param  TzFixupRuleMatchRule $daylight
     * @return self
     */
    public function setDaylight(TzFixupRuleMatchRule $daylight)
    {
        return $this->setChild('daylight', $daylight);
    }

    /**
     * Gets the stdoff
     *
     * @return int
     */
    public function getStdOffset()
    {
        return $this->getProperty('stdoff');
    }

    /**
     * Sets the stdoff
     *
     * @param  int $stdoff
     * @return self
     */
    public function setStdOffset($stdoff)
    {
        return $this->setProperty('stdoff', (int) $stdoff);
    }

    /**
     * Gets the dayoff
     *
     * @return int
     */
    public function getDstOffset()
    {
        return $this->getProperty('dayoff');
    }

    /**
     * Sets the dayoff
     *
     * @param  int $dayoff
     * @return self
     */
    public function setDstOffset($dayoff)
    {
        return $this->setProperty('dayoff', (int) $dayoff);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rules')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'rules')
    {
        return parent::toXml($name);
    }
}