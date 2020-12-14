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
 * ComparisonComparator enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ComparisonComparator extends Enum
{
    /**
     * Constant for value 'i;ascii-numeric'
     * @return string 'i;ascii-numeric'
     */
    private const ASCII_NUMERIC = 'i;ascii-numeric';

    /**
     * Constant for value 'i;ascii-casemap'
     * @return string 'i;ascii-casemap'
     */
    private const ASCII_CASEMAP = 'i;ascii-casemap';

    /**
     * Constant for value 'i;octet'
     * @return string 'i;octet'
     */
    private const OCTET = 'i;octet';
}
