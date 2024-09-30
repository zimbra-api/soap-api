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
 * Action enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum Action: string
{
    /**
     * Constant for value 'edit'
     * @return string 'edit'
     */
    case EDIT = "edit";

    /**
     * Constant for value 'revoke'
     * @return string 'revoke'
     */
    case REVOKE = "revoke";

    /**
     * Constant for value 'expire'
     * @return string 'expire'
     */
    case EXPIRE = "expire";

    /**
     * Constant for value 'start'
     * @return string 'start'
     */
    case START = "start";

    /**
     * Constant for value 'status'
     * @return string 'status'
     */
    case STATUS = "status";

    /**
     * Constant for value 'stop'
     * @return string 'stop'
     */
    case STOP = "stop";
}
