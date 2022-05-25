<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Enum;

use MyCLabs\Enum\Enum;

/**
 * WeekDay enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class WeekDay extends Enum
{
    /**
     * Constant for value 'SU'
     * @return string 'SU'
     */
    private const SU = 'SU';

    /**
     * Constant for value 'MO'
     * @return string 'MO'
     */
    private const MO = 'MO';

    /**
     * Constant for value 'TU'
     * @return string 'TU'
     */
    private const TU = 'TU';

    /**
     * Constant for value 'WE'
     * @return string 'WE'
     */
    private const WE = 'WE';

    /**
     * Constant for value 'TH'
     * @return string 'TH'
     */
    private const TH = 'TH';

    /**
     * Constant for value 'FR'
     * @return string 'FR'
     */
    private const FR = 'FR';

    /**
     * Constant for value 'SA'
     * @return string 'SA'
     */
    private const SA = 'SA';
}
