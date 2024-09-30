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
 * FolderAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FolderActionOp extends Enum
{
    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    protected const READ = "read";

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    protected const DELETE = "delete";

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    protected const RENAME = "rename";

    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    protected const MOVE = "move";

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    protected const TRASH = "trash";

    /**
     * Constant for value 'empty'
     * @return string 'empty'
     */
    protected const IS_EMPTY = "empty";

    /**
     * Constant for value 'color'
     * @return string 'color'
     */
    protected const COLOR = "color";

    /**
     * Constant for value 'grant'
     * @return string 'grant'
     */
    protected const GRANT = "grant";

    /**
     * Constant for value '[!]grant'
     * @return string '[!]grant'
     */
    protected const NOT_GRANT = "!grant";

    /**
     * Constant for value 'revokeorphangrants'
     * @return string 'revokeorphangrants'
     */
    protected const REVOKE_ORPHAN_GRANTS = "revokeorphangrants";

    /**
     * Constant for value 'url'
     * @return string 'url'
     */
    protected const URL = "url";

    /**
     * Constant for value 'import'
     * @return string 'import'
     */
    protected const IMPORT = "import";

    /**
     * Constant for value 'sync'
     * @return string 'sync'
     */
    protected const SYNC = "sync";

    /**
     * Constant for value 'fb'
     * @return string 'fb'
     */
    protected const FB = "fb";

    /**
     * Constant for value 'check'
     * @return string 'check'
     */
    protected const CHECK = "check";

    /**
     * Constant for value '!check'
     * @return string '!check'
     */
    protected const NOT_CHECK = "!check";

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    protected const UPDATE = "update";

    /**
     * Constant for value 'syncon'
     * @return string 'syncon'
     */
    protected const SYNCON = "syncon";

    /**
     * Constant for value '!syncon'
     * @return string '!syncon'
     */
    protected const NOT_SYNCON = "!syncon";

    /**
     * Constant for value 'retentionpolicy'
     * @return string 'retentionpolicy'
     */
    protected const RETENTION_POLICY = "retentionpolicy";

    /**
     * Constant for value 'disableactivesync'
     * @return string 'disableactivesync'
     */
    protected const DISABLE_ACTIVE_SYNC = "disableactivesync";

    /**
     * Constant for value '!disableactivesync'
     * @return string '!disableactivesync'
     */
    protected const NOT_DISABLE_ACTIVE_SYNC = "!disableactivesync";
}
