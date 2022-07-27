<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

/**
 * ExceptionRecurIdInfoInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface ExceptionRecurIdInfoInterface
{
    function setDateTime(string $dateTime): self;
    function setTimezone(string $timezone): self;
    function setRecurrenceRangeType(int $recurrenceRangeType): self;

    function getDateTime(): string;
    function getTimezone(): ?string;
    function getRecurrenceRangeType(): ?int;
}
