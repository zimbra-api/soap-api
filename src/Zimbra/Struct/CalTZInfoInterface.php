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
 * CalTZInfoInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface CalTZInfoInterface
{
    function setStandardTzOnset(TzOnsetInfo $standardTzOnset): self;
    function setDaylightTzOnset(TzOnsetInfo $daylightTzOnset): self;
    function setStandardTZName(string $standardTZName): self;
    function setDaylightTZName(string $daylightTZName): self;
    function getId(): string;
    function getTzStdOffset(): int;
    function getTzDayOffset(): int;
    function getStandardTzOnset(): ?TzOnsetInfo;
    function getDaylightTzOnset(): ?TzOnsetInfo;
    function getStandardTZName(): ?string;
    function getDaylightTZName(): ?string;
}
