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
 * TagAction enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TagActionOp extends Base
{
    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    const READ = 'read';

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    const RENAME = 'rename';

    /**
     * Constant for value 'color'
     * @return string 'color'
     */
    const COLOR = 'color';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    const DELETE = 'delete';

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    const UPDATE = 'update';

    /**
     * Constant for value 'retentionpolicy'
     * @return string 'retentionpolicy'
     */
    const RETENTION = 'retentionpolicy';
}
