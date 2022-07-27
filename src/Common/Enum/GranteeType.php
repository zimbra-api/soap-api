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
 * GranteeType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GranteeType extends Enum
{
    /**
     * Constant for value 'usr'
     * @return string 'usr'
     */
    private const USR = 'usr';

    /**
     * Constant for value 'grp'
     * @return string 'grp'
     */
    private const GRP = 'grp';

    /**
     * Constant for value 'egp'
     * @return string 'egp'
     */
    private const EGP = 'egp';

    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    private const ALL = 'all';

    /**
     * Constant for value 'dom'
     * @return string 'dom'
     */
    private const DOM = 'dom';

    /**
     * Constant for value 'edom'
     * @return string 'edom'
     */
    private const EDOM = 'edom';

    /**
     * Constant for value 'gst'
     * @return string 'gst'
     */
    private const GST = 'gst';

    /**
     * Constant for value 'key'
     * @return string 'key'
     */
    private const KEY = 'key';

    /**
     * Constant for value 'pub'
     * @return string 'pub'
     */
    private const PUB = 'pub';

    /**
     * Constant for value 'email'
     * @return string 'email'
     */
    private const EMAIL = 'email';
}
