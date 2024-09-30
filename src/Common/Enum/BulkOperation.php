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

/**
 * BulkOperation enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum BulkOperation: string
{
    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    case MOVE = "move";

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    case READ = "read";

    /**
     * Constant for value 'unread'
     * @return string 'unread'
     */
    case UNREAD = "unread";
}
