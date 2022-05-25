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
 * VoiceMsgActionOp enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class VoiceMsgActionOp extends Enum
{
    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    private const MOVE = 'move';

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    private const READ = 'read';

    /**
     * Constant for value '!read'
     * @return string '!read'
     */
    private const NOT_READ = '!read';

    /**
     * Constant for value 'empty'
     * @return string 'empty'
     */
    private const IS_EMPTY = 'empty';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    private const DELETE = 'delete';
}
