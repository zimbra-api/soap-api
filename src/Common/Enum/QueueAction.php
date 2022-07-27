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
 * QueueAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class QueueAction extends Enum
{
    /**
     * Constant for value 'hold'
     * @return string 'hold'
     */
    private const HOLD = 'hold';

    /**
     * Constant for value 'release'
     * @return string 'release'
     */
    private const RELEASE = 'release';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    private const DELETE = 'delete';

    /**
     * Constant for value 'requeue'
     * @return string 'requeue'
     */
    private const REQUEUE = 'requeue';
}
