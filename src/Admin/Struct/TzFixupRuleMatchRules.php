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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * TzFixupRuleMatchRules struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TzFixupRuleMatchRules
{
    /**
     * Standard match rule
     * 
     * @var TzFixupRuleMatchRule
     */
    #[Accessor(getter: 'getStandard', setter: 'setStandard')]
    #[SerializedName('standard')]
    #[Type(TzFixupRuleMatchRule::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private TzFixupRuleMatchRule $standard;

    /**
     * Daylight saving match rule
     * 
     * @var TzFixupRuleMatchRule
     */
    #[Accessor(getter: 'getDaylight', setter: 'setDaylight')]
    #[SerializedName('daylight')]
    #[Type(TzFixupRuleMatchRule::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private TzFixupRuleMatchRule $daylight;

    /**
     * Offset from UTC in standard time; local = UTC + offset
     * 
     * @var int
     */
    #[Accessor(getter: 'getStdOffset', setter: 'setStdOffset')]
    #[SerializedName('stdoff')]
    #[Type('int')]
    #[XmlAttribute]
    private $stdOffset;

    /**
     * Offset from UTC in daylight time; present only if DST is used
     * 
     * @var int
     */
    #[Accessor(getter: 'getDstOffset', setter: 'setDstOffset')]
    #[SerializedName('dayoff')]
    #[Type('int')]
    #[XmlAttribute]
    private $dstOffset;

    /**
     * Constructor
     * 
     * @param TzFixupRuleMatchRule $standard
     * @param TzFixupRuleMatchRule $daylight
     * @param int $stdoff
     * @param int $dayoff
     * @return self
     */
    public function __construct(
        TzFixupRuleMatchRule $standard,
        TzFixupRuleMatchRule $daylight,
        int $stdoff = 0,
        int $dayoff = 0
    )
    {
        $this->setStandard($standard)
             ->setDaylight($daylight)
             ->setStdOffset($stdoff)
             ->setDstOffset($dayoff);
    }

    /**
     * Get the standard match date.
     *
     * @return TzFixupRuleMatchRule
     */
    public function getStandard(): TzFixupRuleMatchRule
    {
        return $this->standard;
    }

    /**
     * Set the standard match date.
     *
     * @param  TzFixupRuleMatchRule $standard
     * @return self
     */
    public function setStandard(TzFixupRuleMatchRule $standard): self
    {
        $this->standard = $standard;
        return $this;
    }

    /**
     * Get the daylight match date.
     *
     * @return TzFixupRuleMatchRule
     */
    public function getDaylight(): TzFixupRuleMatchRule
    {
        return $this->daylight;
    }

    /**
     * Set the daylight match date.
     *
     * @param  TzFixupRuleMatchRule $daylight
     * @return self
     */
    public function setDaylight(TzFixupRuleMatchRule $daylight): self
    {
        $this->daylight = $daylight;
        return $this;
    }

    /**
     * Get the stdoff
     *
     * @return int
     */
    public function getStdOffset(): int
    {
        return $this->stdOffset;
    }

    /**
     * Set the stdoff
     *
     * @param  int $stdoff
     * @return self
     */
    public function setStdOffset(int $stdoff): self
    {
        $this->stdOffset = $stdoff;
        return $this;
    }

    /**
     * Get the dayoff
     *
     * @return int
     */
    public function getDstOffset(): int
    {
        return $this->dstOffset;
    }

    /**
     * Set the dayoff
     *
     * @param  int $dayoff
     * @return self
     */
    public function setDstOffset(int $dayoff): self
    {
        $this->dstOffset = $dayoff;
        return $this;
    }
}