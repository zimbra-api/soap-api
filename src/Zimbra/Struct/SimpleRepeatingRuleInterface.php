<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use Zimbra\Enum\Frequency;

/**
 * SimpleRepeatingRuleInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface SimpleRepeatingRuleInterface
{
    function getFrequency(): Frequency;

    function setUntil(DateTimeStringAttrInterface $until): self;
    function setCount(NumAttrInterface $count): self;
    function setInterval(IntervalRuleInterface $interval): self;
    function setBySecond(BySecondRuleInterface $bySecond): self;
    function setByMinute(ByMinuteRuleInterface $byMinute): self;
    function setByHour(ByHourRuleInterface $byHour): self;
    function setByDay(ByDayRuleInterface $byDay): self;
    function setByMonthDay(ByMonthDayRuleInterface $byMonthDay): self;
    function setByYearDay(ByYearDayRuleInterface $byYearDay): self;
    function setByWeekNo(ByWeekNoRuleInterface $byWeekNo): self;
    function setByMonth(ByMonthRuleInterface $byMonth): self;
    function setBySetPos(BySetPosRuleInterface $bySetPos): self;
    function setWeekStart(WkstRuleInterface $weekStart): self;
    function setXNames(array $xNames): self;
    function addXName(XNameRuleInterface $xName): self;

    function getUntil(): ?DateTimeStringAttrInterface;
    function getCount(): ?NumAttrInterface;
    function getInterval(): ?IntervalRuleInterface;
    function getBySecond(): ?BySecondRuleInterface;
    function getByMinute(): ?ByMinuteRuleInterface;
    function getByHour(): ?ByHourRuleInterface;
    function getByDay(): ?ByDayRuleInterface;
    function getByMonthDay(): ?ByMonthDayRuleInterface;
    function getByYearDay(): ?ByYearDayRuleInterface;
    function getByWeekNo(): ?ByWeekNoRuleInterface;
    function getByMonth(): ?ByMonthRuleInterface;
    function getBySetPos(): ?BySetPosRuleInterface;
    function getWeekStart(): ?WkstRuleInterface;
    function getXNames(): array;
}
