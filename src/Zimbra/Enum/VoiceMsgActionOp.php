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
 * VoiceMsgActionOp enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VoiceMsgActionOp extends Base
{
    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    const MOVE = 'move';

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    const READ = 'read';

    /**
     * Constant for value '!read'
     * @return string '!read'
     */
    const NOT_READ = '!read';

    /**
     * Constant for value 'empty'
     * @return string 'empty'
     */
    const IS_EMPTY = 'empty';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    const DELETE = 'delete';
}
