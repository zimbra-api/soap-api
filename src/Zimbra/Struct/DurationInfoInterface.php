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

/**
 * DurationInfoInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface DurationInfoInterface
{
    function setDurationNegative(bool $durationNegative): self;
    function setWeeks(int $weeks): self;
    function setDays(int $days): self;
    function setHours(int $hours): self;
    function setMinutes(int $minutes): self;
    function setSeconds(int $seconds): self;
    function setRelated(string $related): self;
    function setRepeatCount(int $repeatCount): self;

    function getDurationNegative(): bool;
    function getWeeks(): int;
    function getDays(): int;
    function getHours(): int;
    function getMinutes(): int;
    function getSeconds(): int;
    function getRelated(): string;
    function getRepeatCount(): int;
}
