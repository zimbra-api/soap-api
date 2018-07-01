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
 * MsgActionOp enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MsgActionOp extends Base
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    const DELETE = 'delete';

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    const READ = 'read';

    /**
     * Constant for value 'flag'
     * @return string 'flag'
     */
    const FLAG = 'flag';

    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    const TAG = 'tag';

    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    const MOVE = 'move';

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    const UPDATE = 'update';

    /**
     * Constant for value 'spam'
     * @return string 'spam'
     */
    const SPAM = 'spam';

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    const TRASH = 'trash';
}
