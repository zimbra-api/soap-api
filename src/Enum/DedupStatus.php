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
 * DedupStatus enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DedupStatus extends Enum
{
    /**
     * Constant for value 'running'
     * @return string 'running'
     */
    private const RUNNING = 'running';

    /**
     * Constant for value 'stopped'
     * @return string 'stopped'
     */
    private const STOPPED = 'stopped';
}