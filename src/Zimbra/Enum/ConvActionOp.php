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
 * ConvActionOp enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ConvActionOp extends Enum
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    private const DELETE = 'delete';

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    private const READ = 'read';

    /**
     * Constant for value 'flag'
     * @return string 'flag'
     */
    private const FLAG = 'flag';

    /**
     * Constant for value 'priority'
     * @return string 'priority'
     */
    private const PRIORITY = 'priority';
    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    private const TAG = 'tag';

    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    private const MOVE = 'move';

    /**
     * Constant for value 'spam'
     * @return string 'spam'
     */
    private const SPAM = 'spam';

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    private const TRASH = 'trash';
}
