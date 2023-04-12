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
 * ContactActionOp enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ContactActionOp: string
{
    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    case MOVE = 'move';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    case DELETE = 'delete';

    /**
     * Constant for value 'flag'
     * @return string 'flag'
     */
    case FLAG = 'flag';

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    case TRASH = 'trash';

    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    case TAG = 'tag';

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    case UPDATE = 'update';
}
