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
            $this->child('any', $any);
        }
        if($tzid instanceof Id)
        {
            $this->child('tzid', $tzid);
        }
        if($nonDst instanceof Offset)
        {
            $this->child('nonDst', $nonDst);
        }
        if($rules instanceof TzFixupRuleMatchRules)
        {
            $this->child('rules', $rules);
        }
        if($dates instanceof TzFixupRuleMatchDates)
        {
            $this->child('dates', $dates);
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
            return $this->child('any');
        }
        return $this->child('any', $any);
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
            return $this->child('tzid');
        }
        return $this->child('tzid', $tzid);
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
            return $this->child('nonDst');
        }
        return $this->child('nonDst', $nonDst);
    }

    /**
     * Gets or sets rules
     *
     * @param  TzFixupRuleMatchRules $rules
     * @return TzFixupRuleMatchRules|self
     */
    public function rules(TzFixupRuleMatchRules $rules = null)
    {
        if(null === $rules)
        {
            return $this->child('rules');
        }
        return $this->child('rules', $rules);
    }

    /**
     * Gets or sets dates
     *
     * @param  TzFixupRuleMatchDates $dates
     * @return TzFixupRuleMatchDates|self
     */
    public function dates(TzFixupRuleMatchDates $dates = null)
    {
        if(null === $dates)
        {
            return $this->child('dates');
        }
        return $this->child('dates', $dates);
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
