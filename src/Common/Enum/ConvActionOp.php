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
 * ConvActionOp enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ConvActionOp: string
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    case DELETE = 'delete';

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    case READ = 'read';

    /**
     * Constant for value 'flag'
     * @return string 'flag'
     */
    case FLAG = 'flag';

    /**
     * Constant for value 'priority'
     * @return string 'priority'
     */
    case PRIORITY = 'priority';
    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    case TAG = 'tag';

    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    case MOVE = 'move';

    /**
     * Constant for value 'spam'
     * @return string 'spam'
     */
    case SPAM = 'spam';

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    case TRASH = 'trash';
}
