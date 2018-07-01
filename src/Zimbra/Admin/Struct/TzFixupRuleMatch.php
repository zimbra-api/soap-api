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
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\Id;

/**
 * TzFixupRuleMatch struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="match")
 */
class TzFixupRuleMatch
{
    /**
     * @Accessor(getter="getAny", setter="setAny")
     * @SerializedName("any")
     * @Type("Zimbra\Admin\Struct\SimpleElement")
     * @XmlElement
     */
    private $_any;

    /**
     * @Accessor(getter="getTzid", setter="setTzid")
     * @SerializedName("tzid")
     * @Type("Zimbra\Struct\Id")
     * @XmlElement
     */
    private $_tzid;

    /**
     * @Accessor(getter="getNonDst", setter="setNonDst")
     * @SerializedName("nonDst")
     * @Type("Zimbra\Admin\Struct\Offset")
     * @XmlElement
     */
    private $_nonDst;

    /**
     * @Accessor(getter="getRules", setter="setRules")
     * @SerializedName("rules")
     * @Type("Zimbra\Admin\Struct\TZFixupRuleMatchRules")
     * @XmlElement
     */
    private $_rules;

    /**
     * @Accessor(getter="getDates", setter="setDates")
     * @SerializedName("dates")
     * @Type("Zimbra\Admin\Struct\TZFixupRuleMatchDates")
     * @XmlElement
     */
    private $_dates;

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
        SimpleElement $any = NULL,
        Id $tzid = NULL,
        Offset $nonDst = NULL,
        TzFixupRuleMatchRules $rules = NULL,
        TzFixupRuleMatchDates $dates = NULL
    )
    {
        if ($any instanceof SimpleElement) {
            $this->setAny($any);
        }
        if ($tzid instanceof Id) {
            $this->setTzid($tzid);
        }
        if ($nonDst instanceof Offset) {
            $this->setNonDst($nonDst);
        }
        if ($rules instanceof TzFixupRuleMatchRules) {
            $this->setRules($rules);
        }
        if ($dates instanceof TzFixupRuleMatchDates) {
            $this->setDates($dates);
        }
    }

    /**
     * Gets the any.
     *
     * @return SimpleElement
     */
    public function getAny()
    {
        return $this->_any;
    }

    /**
     * Sets the any.
     *
     * @param  SimpleElement $any
     * @return self
     */
    public function setAny(SimpleElement $any)
    {
        $this->_any = $any;
        return $this;
    }

    /**
     * Gets the tzid.
     *
     * @return Id
     */
    public function getTzid()
    {
        return $this->_tzid;
    }

    /**
     * Sets the tzid.
     *
     * @param  Id $tzid
     * @return self
     */
    public function setTzid(Id $tzid)
    {
        $this->_tzid = $tzid;
        return $this;
    }

    /**
     * Gets the nonDst.
     *
     * @return Offset
     */
    public function getNonDst()
    {
        return $this->_nonDst;
    }

    /**
     * Sets the nonDst.
     *
     * @param  Offset $nonDst
     * @return self
     */
    public function setNonDst(Offset $nonDst)
    {
        $this->_nonDst = $nonDst;
        return $this;
    }

    /**
     * Gets the rules.
     *
     * @return TzFixupRuleMatchRules
     */
    public function getRules()
    {
        return $this->_rules;
    }

    /**
     * Sets the rules.
     *
     * @param  TzFixupRuleMatchRules $rules
     * @return self
     */
    public function setRules(TzFixupRuleMatchRules $rules)
    {
        $this->_rules = $rules;
        return $this;
    }

    /**
     * Gets the dates.
     *
     * @return TzFixupRuleMatchDates
     */
    public function getDates()
    {
        return $this->_dates;
    }

    /**
     * Sets the dates.
     *
     * @param  TzFixupRuleMatchDates $dates
     * @return self
     */
    public function setDates(TzFixupRuleMatchDates $dates)
    {
        $this->_dates = $dates;
        return $this;
    }
}
