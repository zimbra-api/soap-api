<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * FreeBusyStatus enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FreeBusyStatus extends Enum
{
    /**
     * Constant for value 'Free'
     * @return string 'F'
     */
    private const FREE = 'F';

    /**
     * Constant for value 'Busy'
     * @return string 'B'
     */
    private const BUSY = 'B';

    /**
     * Constant for value 'Busy-Tentative'
     * @return string 'T'
     */
    private const TENTATIVE = 'T';

    /**
     * Constant for value 'OutOfOffice' (busy-unavailable)
     * @return string 'U'
     */
    private const OUT_OF_OFFICE = 'U';
}
