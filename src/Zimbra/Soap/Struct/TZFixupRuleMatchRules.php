<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * TZFixupRuleMatchRules class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TZFixupRuleMatchRules
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
     * @var TZFixupRuleMatchRule
     */
    private $_standard;

    /**
     * Daylight saving match rule
     * @var TZFixupRuleMatchRule
     */
    private $_daylight;

    /**
     * Constructor method for TZFixupRuleMatchRules
     * @param int $stdoff
     * @param int $dayoff
     * @param TZFixupRuleMatchRule $standard
     * @param TZFixupRuleMatchRule $daylight
     * @return self
     */
    public function __construct(
        $stdoff,
        $dayoff,
        TZFixupRuleMatchRule $standard,
        TZFixupRuleMatchRule $daylight)
    {
        $this->_stdoff = (int) $stdoff;
        $this->_dayoff = (int) $dayoff;
        $this->_standard = $standard;
        $this->_daylight = $daylight;
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
            return $this->_stdoff;
        }
        $this->_stdoff = (int) $stdoff;
        return $this;
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
            return $this->_dayoff;
        }
        $this->_dayoff = (int) $dayoff;
        return $this;
    }

    /**
     * Gets or sets standard
     *
     * @param  TZFixupRuleMatchRule $standard
     * @return TZFixupRuleMatchRule|self
     */
    public function standard(TZFixupRuleMatchRule $standard = null)
    {
        if(null === $standard)
        {
            return $this->_standard;
        }
        $this->_standard = $standard;
        return $this;
    }

    /**
     * Gets or sets daylight
     *
     * @param  TZFixupRuleMatchRule $daylight
     * @return TZFixupRuleMatchRule|self
     */
    public function daylight(TZFixupRuleMatchRule $daylight = null)
    {
        if(null === $daylight)
        {
            return $this->_daylight;
        }
        $this->_daylight = $daylight;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rules')
    {
        $name = !empty($name) ? $name : 'rules';
        $arr = array(
            'stdoff' => $this->_stdoff,
            'dayoff' => $this->_dayoff,
        );
        $arr += $this->_standard->toArray('standard');
        $arr += $this->_daylight->toArray('daylight');
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'rules')
    {
        $name = !empty($name) ? $name : 'rules';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('stdoff', $this->_stdoff)
            ->addAttribute('dayoff', $this->_dayoff)
            ->append($this->_standard->toXml('standard'))
            ->append($this->_daylight->toXml('daylight'));
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}