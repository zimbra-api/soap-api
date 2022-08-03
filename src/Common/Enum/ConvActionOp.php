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
 * ConvActionOp enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConvActionOp extends Enum
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    protected const DELETE = 'delete';

    /**
     * Constant for value 'read'
     * @return string 'read'
     */
    protected const READ = 'read';

    /**
     * Constant for value 'flag'
     * @return string 'flag'
     */
    protected const FLAG = 'flag';

    /**
     * Constant for value 'priority'
     * @return string 'priority'
     */
    protected const PRIORITY = 'priority';
    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    protected const TAG = 'tag';

    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    protected const MOVE = 'move';

    /**
     * Constant for value 'spam'
     * @return string 'spam'
     */
    protected const SPAM = 'spam';

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    protected const TRASH = 'trash';
}
