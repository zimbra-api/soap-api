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
 * RightClass enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum RightClass: string
{
    /**
     * Constant for value 'ADMIN'
     * @return string 'ADMIN'
     */
    case ADMIN = "ADMIN";

    /**
     * Constant for value 'USER'
     * @return string 'USER'
     */
    case USER = "USER";

    /**
     * Constant for value 'ALL'
     * @return string 'ALL'
     */
    case ALL = "ALL";
}
