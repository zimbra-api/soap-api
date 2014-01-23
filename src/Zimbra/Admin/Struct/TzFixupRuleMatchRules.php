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
     * Offset from UTC in standard time; local = UTC + offset
     * @var int
     */
    private $_stdoff;

    /**
     * Offset from UTC in daylight time; present only if DST is used
     * @var int
     */
    private $_dayoff;

    /**
     * Standard match rule
     * @var TzFixupRuleMatchRule
     */
    private $_standard;

    /**
     * Daylight saving match rule
     * @var TzFixupRuleMatchRule
     */
    private $_daylight;

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
     * @param  TzFixupRuleMatchRule $standard
     * @return TzFixupRuleMatchRule|self
     */
    public function standard(TzFixupRuleMatchRule $standard = null)
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
     * @param  TzFixupRuleMatchRule $daylight
     * @return TzFixupRuleMatchRule|self
     */
    public function daylight(TzFixupRuleMatchRule $daylight = null)
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