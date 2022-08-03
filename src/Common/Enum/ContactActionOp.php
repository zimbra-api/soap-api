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
 * ContactActionOp enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactActionOp extends Enum
{
    /**
     * Constant for value 'move'
     * @return string 'move'
     */
    protected const MOVE = 'move';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    protected const DELETE = 'delete';

    /**
     * Constant for value 'flag'
     * @return string 'flag'
     */
    protected const FLAG = 'flag';

    /**
     * Constant for value 'trash'
     * @return string 'trash'
     */
    protected const TRASH = 'trash';

    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    protected const TAG = 'tag';

    /**
     * Constant for value 'update'
     * @return string 'update'
     */
    protected const UPDATE = 'update';
}
