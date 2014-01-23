<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

/**
 * FolderAction enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FolderActionOp extends Base
{
    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    const READ = 'read';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    const DELETE = 'delete';

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    const RENAME = 'rename';

    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    const MOVE = 'move';

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    const TRASH = 'trash';

    /**
     * Constant for value 'empty'
     * @return string 'empty'
     */
    const IS_EMPTY = 'empty';

    /**
     * Constant for value 'color'
     * @return string 'color'
     */
    const COLOR = 'color';

    /**
     * Constant for value 'grant'
     * @return string 'grant'
     */
    const GRANT = 'grant';

    /**
     * Constant for value '[!]grant'
     * @return string '[!]grant'
     */
    const NOT_GRANT = '!grant';

    /**
     * Constant for value 'revokeorphangrants'
     * @return string 'revokeorphangrants'
     */
    const REVOKE_ORPHAN_GRANTS = 'revokeorphangrants';

    /**
     * Constant for value 'url'
     * @return string 'url'
     */
    const URL = 'url';

    /**
     * Constant for value 'import'
     * @return string 'import'
     */
    const IMPORT = 'import';

    /**
     * Constant for value 'sync'
     * @return string 'sync'
     */
    const SYNC = 'sync';

    /**
     * Constant for value 'fb'
     * @return string 'fb'
     */
    const FB = 'fb';

    /**
     * Constant for value 'check'
     * @return string 'check'
     */
    const CHECK = 'check';

    /**
     * Constant for value '!check'
     * @return string '!check'
     */
    const NOT_CHECK = '!check';

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    const UPDATE = 'update';

    /**
     * Constant for value 'syncon'
     * @return string 'syncon'
     */
    const SYNCON = 'syncon';

    /**
     * Constant for value '!syncon'
     * @return string '!syncon'
     */
    const NOT_SYNCON = '!syncon';

    /**
     * Constant for value 'retentionpolicy'
     * @return string 'retentionpolicy'
     */
    const RETENTION_POLICY = 'retentionpolicy';

    /**
     * Constant for value 'disableactivesync'
     * @return string 'disableactivesync'
     */
    const DISABLE_ACTIVE_SYNC = 'disableactivesync';

    /**
     * Constant for value '!disableactivesync'
     * @return string '!disableactivesync'
     */
    const NOT_DISABLE_ACTIVE_SYNC = '!disableactivesync';
}
