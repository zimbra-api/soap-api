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
 * FolderAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum FolderActionOp: string
{
    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    case READ = "read";

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    case DELETE = "delete";

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    case RENAME = "rename";

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
     * Constant for value 'empty'
     * @return string 'empty'
     */
    case IS_EMPTY = "empty";

    /**
     * Constant for value 'color'
     * @return string 'color'
     */
    case COLOR = "color";

    /**
     * Constant for value 'grant'
     * @return string 'grant'
     */
    case GRANT = "grant";

    /**
     * Constant for value '[!]grant'
     * @return string '[!]grant'
     */
    case NOT_GRANT = "!grant";

    /**
     * Constant for value 'revokeorphangrants'
     * @return string 'revokeorphangrants'
     */
    case REVOKE_ORPHAN_GRANTS = "revokeorphangrants";

    /**
     * Constant for value 'url'
     * @return string 'url'
     */
    case URL = "url";

    /**
     * Constant for value 'import'
     * @return string 'import'
     */
    case IMPORT = "import";

    /**
     * Constant for value 'sync'
     * @return string 'sync'
     */
    case SYNC = "sync";

    /**
     * Constant for value 'fb'
     * @return string 'fb'
     */
    case FB = "fb";

    /**
     * Constant for value 'check'
     * @return string 'check'
     */
    case CHECK = "check";

    /**
     * Constant for value '!check'
     * @return string '!check'
     */
    case NOT_CHECK = "!check";

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    case UPDATE = "update";

    /**
     * Constant for value 'syncon'
     * @return string 'syncon'
     */
    case SYNCON = "syncon";

    /**
     * Constant for value '!syncon'
     * @return string '!syncon'
     */
    case NOT_SYNCON = "!syncon";

    /**
     * Constant for value 'retentionpolicy'
     * @return string 'retentionpolicy'
     */
    case RETENTION_POLICY = "retentionpolicy";

    /**
     * Constant for value 'disableactivesync'
     * @return string 'disableactivesync'
     */
    case DISABLE_ACTIVE_SYNC = "disableactivesync";

    /**
     * Constant for value '!disableactivesync'
     * @return string '!disableactivesync'
     */
    case NOT_DISABLE_ACTIVE_SYNC = "!disableactivesync";
}
