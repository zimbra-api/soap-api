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
 * CompactIndexStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CompactIndexStatus extends Enum
{
    /**
     * Constant for value 'started'
     * @return string 'started'
     */
    protected const STARTED = 'started';

    /**
     * Constant for value 'status'
     * @return string 'status'
     */
    protected const RUNNING = 'running';

    /**
     * Constant for value 'status'
     * @return string 'status'
     */
    protected const IDLE = 'idle';
}