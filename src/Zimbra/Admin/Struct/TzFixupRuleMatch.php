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
use Zimbra\Struct\Id;

/**
 * TzFixupRuleMatch struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzFixupRuleMatch extends Base
{
    /**
     * Constructor method for TzFixupRuleMatch
     * @param SimpleElement $any Simple element
     * @param Id $tzid Tz ID
     * @param Offset $nonDst Offset
     * @param TzFixupRuleMatchRules $rules Rules
     * @param TzFixupRuleMatchDates $dates Dates
     * @return self
     */
    public function __construct(
        SimpleElement $any = null,
        Id $tzid = null,
        Offset $nonDst = null,
        TzFixupRuleMatchRules $rules = null,
        TzFixupRuleMatchDates $dates = null
    )
    {
        parent::__construct();
        if($any instanceof SimpleElement)
        {
            $this->setChild('any', $any);
        }
        if($tzid instanceof Id)
        {
            $this->setChild('tzid', $tzid);
        }
        if($nonDst instanceof Offset)
        {
            $this->setChild('nonDst', $nonDst);
        }
        if($rules instanceof TzFixupRuleMatchRules)
        {
            $this->setChild('rules', $rules);
        }
        if($dates instanceof TzFixupRuleMatchDates)
        {
            $this->setChild('dates', $dates);
        }
    }

    /**
     * Gets the any.
     *
     * @return SimpleElement
     */
    public function getAny()
    {
        return $this->getChild('any');
    }

    /**
     * Sets the any.
     *
     * @param  SimpleElement $any
     * @return self
     */
    public function setAny(SimpleElement $any)
    {
        return $this->setChild('any', $any);
    }

    /**
     * Gets the tzid.
     *
     * @return Id
     */
    public function getTzid()
    {
        return $this->getChild('tzid');
    }

    /**
     * Sets the tzid.
     *
     * @param  Id $tzid
     * @return self
     */
    public function setTzid(Id $tzid)
    {
        return $this->setChild('tzid', $tzid);
    }

    /**
     * Gets the nonDst.
     *
     * @return Offset
     */
    public function getNonDst()
    {
        return $this->getChild('nonDst');
    }

    /**
     * Sets the nonDst.
     *
     * @param  Offset $nonDst
     * @return self
     */
    public function setNonDst(Offset $nonDst)
    {
        return $this->setChild('nonDst', $nonDst);
    }

    /**
     * Gets the rules.
     *
     * @return TzFixupRuleMatchRules
     */
    public function getRules()
    {
        return $this->getChild('rules');
    }

    /**
     * Sets the rules.
     *
     * @param  TzFixupRuleMatchRules $rules
     * @return self
     */
    public function setRules(TzFixupRuleMatchRules $rules)
    {
        return $this->setChild('rules', $rules);
    }

    /**
     * Gets the dates.
     *
     * @return TzFixupRuleMatchDates
     */
    public function getDates()
    {
        return $this->getChild('dates');
    }

    /**
     * Sets the dates.
     *
     * @param  TzFixupRuleMatchDates $dates
     * @return self
     */
    public function setDates(TzFixupRuleMatchDates $dates)
    {
        return $this->setChild('dates', $dates);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'match')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'match')
    {
        return parent::toXml($name);
    }
}
