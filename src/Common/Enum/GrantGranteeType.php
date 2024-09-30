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
 * GrantGranteeType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum GrantGranteeType: string
{
    /**
     * access is granted to an authenticated user
     * Constant for value 'usr'
     * @return string 'usr'
     */
    case USR = "usr";

    /**
     * access is granted to a group of users
     * Constant for value 'grp'
     * @return string 'grp'
     */
    case GRP = "grp";

    /**
     * access is granted to users on a cos
     * Constant for value 'cos'
     * @return string 'cos'
     */
    case COS = "cos";

    /**
     * access is granted to public. no authentication needed.
     * Constant for value 'pub'
     * @return string 'pub'
     */
    case PUB = "pub";

    /**
     * access is granted to all authenticated users
     * Constant for value 'all'
     * @return string 'all'
     */
    case ALL = "all";

    /**
     * access is granted to all users in a domain
     * Constant for value 'dom'
     * @return string 'dom'
     */
    case DOM = "dom";

    /**
     * access is granted to a non-Zimbra email address and a password
     * Constant for value 'guest'
     * @return string 'guest'
     */
    case GUEST = "guest";

    /**
     * access is granted to a non-Zimbra email address and an accesskey
     * Constant for value 'key'
     * @return string 'key'
     */
    case KEY = "key";
}
