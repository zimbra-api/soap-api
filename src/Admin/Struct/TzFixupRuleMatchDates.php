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
 * TzFixupRuleMatchDates struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TzFixupRuleMatchDates
{
    /**
     * Standard match date
     * 
     * @var TzFixupRuleMatchDate
     */
    #[Accessor(getter: 'getStandard', setter: 'setStandard')]
    #[SerializedName('standard')]
    #[Type(TzFixupRuleMatchDate::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $standard;

    /**
     * Daylight saving match date
     * 
     * @var TzFixupRuleMatchDate
     */
    #[Accessor(getter: 'getDaylight', setter: 'setDaylight')]
    #[SerializedName('daylight')]
    #[Type(TzFixupRuleMatchDate::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $daylight;

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
     * @param TzFixupRuleMatchDate $standard
     * @param TzFixupRuleMatchDate $daylight
     * @param int $stdoff
     * @param int $dayoff
     * @return self
     */
    public function __construct(
        TzFixupRuleMatchDate $standard,
        TzFixupRuleMatchDate $daylight,
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
     * @return TzFixupRuleMatchDate
     */
    public function getStandard(): TzFixupRuleMatchDate
    {
        return $this->standard;
    }

    /**
     * Set the standard match date.
     *
     * @param  TzFixupRuleMatchDate $standard
     * @return self
     */
    public function setStandard(TzFixupRuleMatchDate $standard): self
    {
        $this->standard = $standard;
        return $this;
    }

    /**
     * Get the daylight match date.
     *
     * @return TzFixupRuleMatchDate
     */
    public function getDaylight(): TzFixupRuleMatchDate
    {
        return $this->daylight;
    }

    /**
     * Set the daylight match date.
     *
     * @param  TzFixupRuleMatchDate $daylight
     * @return self
     */
    public function setDaylight(TzFixupRuleMatchDate $daylight): self
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