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
 * BulkOperation enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BulkOperation extends Enum
{
    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    protected const MOVE = "move";

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    protected const READ = "read";

    /**
     * Constant for value 'unread'
     * @return string 'unread'
     */
    protected const UNREAD = "unread";
}
