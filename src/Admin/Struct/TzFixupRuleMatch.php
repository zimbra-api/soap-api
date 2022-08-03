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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\Id;

/**
 * TzFixupRuleMatch struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TzFixupRuleMatch
{
    /**
     * Simple element
     * @Accessor(getter="getAny", setter="setAny")
     * @SerializedName("any")
     * @Type("Zimbra\Admin\Struct\SimpleElement")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?SimpleElement $any = NULL;

    /**
     * Tz ID
     * @Accessor(getter="getTzid", setter="setTzid")
     * @SerializedName("tzid")
     * @Type("Zimbra\Common\Struct\Id")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Id $tzid = NULL;

    /**
    * Offset
     * @Accessor(getter="getNonDst", setter="setNonDst")
     * @SerializedName("nonDst")
     * @Type("Zimbra\Admin\Struct\Offset")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Offset $nonDst = NULL;

    /**
     * Rules
     * @Accessor(getter="getRules", setter="setRules")
     * @SerializedName("rules")
     * @Type("Zimbra\Admin\Struct\TzFixupRuleMatchRules")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?TzFixupRuleMatchRules $rules = NULL;

    /**
     * Dates
     * @Accessor(getter="getDates", setter="setDates")
     * @SerializedName("dates")
     * @Type("Zimbra\Admin\Struct\TzFixupRuleMatchDates")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?TzFixupRuleMatchDates $dates = NULL;

    /**
     * Constructor method for TzFixupRuleMatch
     * @param SimpleElement $any
     * @param Id $tzid
     * @param Offset $nonDst
     * @param TzFixupRuleMatchRules $rules
     * @param TzFixupRuleMatchDates $dates
     * @return self
     */
    public function __construct(
        ?SimpleElement $any = NULL,
        ?Id $tzid = NULL,
        ?Offset $nonDst = NULL,
        ?TzFixupRuleMatchRules $rules = NULL,
        ?TzFixupRuleMatchDates $dates = NULL
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
     * Get the any.
     *
     * @return SimpleElement
     */
    public function getAny(): ?SimpleElement
    {
        return $this->any;
    }

    /**
     * Set the any.
     *
     * @param  SimpleElement $any
     * @return self
     */
    public function setAny(SimpleElement $any): self
    {
        $this->any = $any;
        return $this;
    }

    /**
     * Get the tzid.
     *
     * @return Id
     */
    public function getTzid(): ?Id
    {
        return $this->tzid;
    }

    /**
     * Set the tzid.
     *
     * @param  Id $tzid
     * @return self
     */
    public function setTzid(Id $tzid): self
    {
        $this->tzid = $tzid;
        return $this;
    }

    /**
     * Get the nonDst.
     *
     * @return Offset
     */
    public function getNonDst(): ?Offset
    {
        return $this->nonDst;
    }

    /**
     * Set the nonDst.
     *
     * @param  Offset $nonDst
     * @return self
     */
    public function setNonDst(Offset $nonDst): self
    {
        $this->nonDst = $nonDst;
        return $this;
    }

    /**
     * Get the rules.
     *
     * @return TzFixupRuleMatchRules
     */
    public function getRules(): ?TzFixupRuleMatchRules
    {
        return $this->rules;
    }

    /**
     * Set the rules.
     *
     * @param  TzFixupRuleMatchRules $rules
     * @return self
     */
    public function setRules(TzFixupRuleMatchRules $rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * Get the dates.
     *
     * @return TzFixupRuleMatchDates
     */
    public function getDates(): ?TzFixupRuleMatchDates
    {
        return $this->dates;
    }

    /**
     * Set the dates.
     *
     * @param  TzFixupRuleMatchDates $dates
     * @return self
     */
    public function setDates(TzFixupRuleMatchDates $dates): self
    {
        $this->dates = $dates;
        return $this;
    }
}
