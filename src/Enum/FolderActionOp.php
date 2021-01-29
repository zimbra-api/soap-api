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
 * FolderAction enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FolderActionOp extends Enum
{
    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    private const READ = 'read';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    private const DELETE = 'delete';

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    private const RENAME = 'rename';

    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    private const MOVE = 'move';

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    private const TRASH = 'trash';

    /**
     * Constant for value 'empty'
     * @return string 'empty'
     */
    private const IS_EMPTY = 'empty';

    /**
     * Constant for value 'color'
     * @return string 'color'
     */
    private const COLOR = 'color';

    /**
     * Constant for value 'grant'
     * @return string 'grant'
     */
    private const GRANT = 'grant';

    /**
     * Constant for value '[!]grant'
     * @return string '[!]grant'
     */
    private const NOT_GRANT = '!grant';

    /**
     * Constant for value 'revokeorphangrants'
     * @return string 'revokeorphangrants'
     */
    private const REVOKE_ORPHAN_GRANTS = 'revokeorphangrants';

    /**
     * Constant for value 'url'
     * @return string 'url'
     */
    private const URL = 'url';

    /**
     * Constant for value 'import'
     * @return string 'import'
     */
    private const IMPORT = 'import';

    /**
     * Constant for value 'sync'
     * @return string 'sync'
     */
    private const SYNC = 'sync';

    /**
     * Constant for value 'fb'
     * @return string 'fb'
     */
    private const FB = 'fb';

    /**
     * Constant for value 'check'
     * @return string 'check'
     */
    private const CHECK = 'check';

    /**
     * Constant for value '!check'
     * @return string '!check'
     */
    private const NOT_CHECK = '!check';

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    private const UPDATE = 'update';

    /**
     * Constant for value 'syncon'
     * @return string 'syncon'
     */
    private const SYNCON = 'syncon';

    /**
     * Constant for value '!syncon'
     * @return string '!syncon'
     */
    private const NOT_SYNCON = '!syncon';

    /**
     * Constant for value 'retentionpolicy'
     * @return string 'retentionpolicy'
     */
    private const RETENTION_POLICY = 'retentionpolicy';

    /**
     * Constant for value 'disableactivesync'
     * @return string 'disableactivesync'
     */
    private const DISABLE_ACTIVE_SYNC = 'disableactivesync';

    /**
     * Constant for value '!disableactivesync'
     * @return string '!disableactivesync'
     */
    private const NOT_DISABLE_ACTIVE_SYNC = '!disableactivesync';
}
