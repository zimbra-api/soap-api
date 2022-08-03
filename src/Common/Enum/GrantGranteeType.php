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
 * GrantGranteeType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GrantGranteeType extends Enum
{
    /**
     * access is granted to an authenticated user
     * Constant for value 'usr'
     * @return string 'usr'
     */
    protected const USR = 'usr';

    /**
     * access is granted to a group of users
     * Constant for value 'grp'
     * @return string 'grp'
     */
    protected const GRP = 'grp';

    /**
     * access is granted to users on a cos
     * Constant for value 'cos'
     * @return string 'cos'
     */
    protected const COS = 'cos';

    /**
     * access is granted to public. no authentication needed.
     * Constant for value 'pub'
     * @return string 'pub'
     */
    protected const PUB = 'pub';

    /**
     * access is granted to all authenticated users
     * Constant for value 'all'
     * @return string 'all'
     */
    protected const ALL = 'all';

    /**
     * access is granted to all users in a domain
     * Constant for value 'dom'
     * @return string 'dom'
     */
    protected const DOM = 'dom';

    /**
     * access is granted to a non-Zimbra email address and a password
     * Constant for value 'guest'
     * @return string 'guest'
     */
    protected const GUEST = 'guest';

    /**
     * access is granted to a non-Zimbra email address and an accesskey
     * Constant for value 'key'
     * @return string 'key'
     */
    protected const KEY = 'key';
}
