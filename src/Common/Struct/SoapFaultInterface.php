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

use Zimbra\Common\Struct\Fault\{Code, Reason};

/**
 * Soap fault interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface SoapFaultInterface
{
    /**
     * Get the fault code struct.
     *
     * @return Code
     */
    function getFaultCode(): ?Code;

    /**
     * Get the fault reason struct.
     *
     * @return Reason
     */
    function getFaultReason(): ?Reason;

    /**
     * Get fault code string.
     *
     * @return string
     */
    function faultCode(): ?string;

    /**
     * Get fault string.
     *
     * @return string
     */
    function faultString(): ?string;
}
