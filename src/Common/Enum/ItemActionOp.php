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
 * ItemActionOp enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ItemActionOp: string
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    case DELETE = "delete";

    /**
     * Constant for value 'dumpsterdelete'
     * @return string 'dumpsterdelete'
     */
    case DUMPSTER_DELETE = "dumpsterdelete";

    /**
     * Constant for value 'recover'
     * @return string 'recover'
     */
    case RECOVER = "recover";

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    case READ = "read";

    /**
     * Constant for value 'flag'
     * @return string 'flag'
     */
    case FLAG = "flag";

    /**
     * Constant for value 'priority'
     * @return string 'priority'
     */
    case PRIORITY = "priority";

    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    case TAG = "tag";

    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    case MOVE = "move";

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    case TRASH = "trash";

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    case RENAME = "rename";

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    case UPDATE = "update";

    /**
     * Constant for value 'color'
     * @return string 'color'
     */
    case COLOR = "color";

    /**
     * Constant for value 'lock'
     * @return string 'lock'
     */
    case LOCK = "lock";

    /**
     * Constant for value 'unlock'
     * @return string 'unlock'
     */
    case UNLOCK = "unlock";
}
