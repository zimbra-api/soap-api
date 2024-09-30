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
 * GranteeType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum GranteeType: string
{
    /**
     * Constant for value 'usr'
     * @return string 'usr'
     */
    case USR = "usr";

    /**
     * Constant for value 'grp'
     * @return string 'grp'
     */
    case GRP = "grp";

    /**
     * Constant for value 'egp'
     * @return string 'egp'
     */
    case EGP = "egp";

    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    case ALL = "all";

    /**
     * Constant for value 'dom'
     * @return string 'dom'
     */
    case DOM = "dom";

    /**
     * Constant for value 'edom'
     * @return string 'edom'
     */
    case EDOM = "edom";

    /**
     * Constant for value 'gst'
     * @return string 'gst'
     */
    case GST = "gst";

    /**
     * Constant for value 'key'
     * @return string 'key'
     */
    case KEY = "key";

    /**
     * Constant for value 'pub'
     * @return string 'pub'
     */
    case PUB = "pub";

    /**
     * Constant for value 'email'
     * @return string 'email'
     */
    case EMAIL = "email";
}
