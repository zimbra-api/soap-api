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
 * DtValInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface DtValInterface
{
    function setStartTime(DtTimeInfoInterface $startTime): self;
    function setEndTime(DtTimeInfoInterface $endTime): self;
    function setDuration(DurationInfoInterface $duration): self;

    function getStartTime(): ?DtTimeInfoInterface;
    function getEndTime(): ?DtTimeInfoInterface;
    function getDuration(): ?DurationInfoInterface;
}
