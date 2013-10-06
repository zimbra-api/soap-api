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
 * TZFixupRuleMatch class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TZFixupRuleMatch
{
    /**
     * Simple element
     * @var SimpleElement
     */
    private $_any;

    /**
     * Tz ID
     * @var Id
     */
    private $_tzid;

    /**
     * Offset
     * @var Offset
     */
    private $_nonDst;

    /**
     * Rules
     * @var TZFixupRuleMatchRules
     */
    private $_rules;

    /**
     * Dates
     * @var TZFixupRuleMatchDates
     */
    private $_dates;

    /**
     * Constructor method for TZFixupRuleMatch
     * @param SimpleElement $any
     * @param Id $tzid
     * @param TZFixupRuleMatchRules $rules
     * @param TZFixupRuleMatchDates $dates
     * @return self
     */
    public function __construct(
        SimpleElement $any = null,
        Id $tzid = null,
        Offset $nonDst = null,
        TZFixupRuleMatchRules $rules = null,
        TZFixupRuleMatchDates $dates = null)
    {
        if($any instanceof SimpleElement)
        {
            $this->_any = $any;
        }
        if($tzid instanceof Id)
        {
            $this->_tzid = $tzid;
        }
        if($nonDst instanceof Offset)
        {
            $this->_nonDst = $nonDst;
        }
        if($rules instanceof TZFixupRuleMatchRules)
        {
            $this->_rules = $rules;
        }
        if($dates instanceof TZFixupRuleMatchDates)
        {
            $this->_dates = $dates;
        }
    }

    /**
     * Gets or sets any
     *
     * @param  SimpleElement $any
     * @return SimpleElement|self
     */
    public function any(SimpleElement $any = null)
    {
        if(null === $any)
        {
            return $this->_any;
        }
        $this->_any = $any;
        return $this;
    }

    /**
     * Gets or sets tzid
     *
     * @param  Id $tzid
     * @return Id|self
     */
    public function tzid(Id $tzid = null)
    {
        if(null === $tzid)
        {
            return $this->_tzid;
        }
        $this->_tzid = $tzid;
        return $this;
    }

    /**
     * Gets or sets nonDst
     *
     * @param  Offset $nonDst
     * @return Offset|self
     */
    public function nonDst(Offset $nonDst = null)
    {
        if(null === $nonDst)
        {
            return $this->_nonDst;
        }
        $this->_nonDst = $nonDst;
        return $this;
    }

    /**
     * Gets or sets rules
     *
     * @param  TZFixupRuleMatchRules $rules
     * @return TZFixupRuleMatchRules|self
     */
    public function rules(TZFixupRuleMatchRules $rules = null)
    {
        if(null === $rules)
        {
            return $this->_rules;
        }
        $this->_rules = $rules;
        return $this;
    }

    /**
     * Gets or sets dates
     *
     * @param  TZFixupRuleMatchDates $dates
     * @return TZFixupRuleMatchDates|self
     */
    public function dates(TZFixupRuleMatchDates $dates = null)
    {
        if(null === $dates)
        {
            return $this->_dates;
        }
        $this->_dates = $dates;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'match')
    {
        $name = !empty($name) ? $name : 'match';
        $arr = array();
        if($this->_any instanceof SimpleElement)
        {
            $arr += $this->_any->toArray('any');
        }
        if($this->_tzid instanceof Id)
        {
            $arr += $this->_tzid->toArray('tzid');
        }
        if($this->_nonDst instanceof Offset)
        {
            $arr += $this->_nonDst->toArray('nonDst');
        }
        if($this->_rules instanceof TZFixupRuleMatchRules)
        {
            $arr += $this->_rules->toArray('rules');
        }
        if($this->_dates instanceof TZFixupRuleMatchDates)
        {
            $arr += $this->_dates->toArray('dates');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'match')
    {
        $name = !empty($name) ? $name : 'match';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_any instanceof SimpleElement)
        {
            $xml->append($this->_any->toXml('any'));
        }
        if($this->_tzid instanceof Id)
        {
            $xml->append($this->_tzid->toXml('tzid'));
        }
        if($this->_nonDst instanceof Offset)
        {
            $xml->append($this->_nonDst->toXml('nonDst'));
        }
        if($this->_rules instanceof TZFixupRuleMatchRules)
        {
            $xml->append($this->_rules->toXml('rules'));
        }
        if($this->_dates instanceof TZFixupRuleMatchDates)
        {
            $xml->append($this->_dates->toXml('dates'));
        }

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
