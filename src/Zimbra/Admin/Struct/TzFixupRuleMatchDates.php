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
 * TzFixupRuleMatchDates struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzFixupRuleMatchDates extends Base
{
    /**
     * Constructor method for TzFixupRuleMatchDates
     * @param TzFixupRuleMatchDate $standard Daylight saving match rule
     * @param TzFixupRuleMatchDate $daylight Standard match rule
     * @param int $stdoff Offset from UTC in standard time; local = UTC + offset
     * @param int $dayoff Offset from UTC in daylight time; present only if DST is used
     * @return self
     */
    public function __construct(
        TzFixupRuleMatchDate $standard,
        TzFixupRuleMatchDate $daylight,
        $stdoff,
        $dayoff
    )
    {
        parent::__construct();
        $this->child('standard', $standard);
        $this->child('daylight', $daylight);
        $this->property('stdoff', (int) $stdoff);
        $this->property('dayoff', (int) $dayoff);
    }

    /**
     * Gets or sets standard
     *
     * @param  TzFixupRuleMatchDate $standard
     * @return TzFixupRuleMatchDate|self
     */
    public function standard(TzFixupRuleMatchDate $standard = null)
    {
        if(null === $standard)
        {
            return $this->child('standard');
        }
        return $this->child('standard', $standard);
    }

    /**
     * Gets or sets daylight
     *
     * @param  TzFixupRuleMatchDate $daylight
     * @return TzFixupRuleMatchDate|self
     */
    public function daylight(TzFixupRuleMatchDate $daylight = null)
    {
        if(null === $daylight)
        {
            return $this->child('daylight');
        }
        return $this->child('daylight', $daylight);
    }

    /**
     * Gets or sets stdoff
     *
     * @param  int $stdoff
     * @return int|self
     */
    public function stdoff($stdoff = null)
    {
        if(null === $stdoff)
        {
            return $this->property('stdoff');
        }
        return $this->property('stdoff', (int) $stdoff);
    }

    /**
     * Gets or sets dayoff
     *
     * @param  int $dayoff
     * @return int|self
     */
    public function dayoff($dayoff = null)
    {
        if(null === $dayoff)
        {
            return $this->property('dayoff');
        }
        return $this->property('dayoff', (int) $dayoff);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dates')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dates')
    {
        return parent::toXml($name);
    }
}