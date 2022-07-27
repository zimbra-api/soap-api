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
 * TagAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TagActionOp extends Enum
{
    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    private const READ = 'read';

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    private const RENAME = 'rename';

    /**
     * Constant for value 'color'
     * @return string 'color'
     */
    private const COLOR = 'color';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    private const DELETE = 'delete';

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    private const UPDATE = 'update';

    /**
     * Constant for value 'retentionpolicy'
     * @return string 'retentionpolicy'
     */
    private const RETENTION = 'retentionpolicy';
}
