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
    protected const USR = 'usr';

    /**
     * Constant for value 'grp'
     * @return string 'grp'
     */
    protected const GRP = 'grp';

    /**
     * Constant for value 'egp'
     * @return string 'egp'
     */
    protected const EGP = 'egp';

    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    protected const ALL = 'all';

    /**
     * Constant for value 'dom'
     * @return string 'dom'
     */
    protected const DOM = 'dom';

    /**
     * Constant for value 'edom'
     * @return string 'edom'
     */
    protected const EDOM = 'edom';

    /**
     * Constant for value 'gst'
     * @return string 'gst'
     */
    protected const GST = 'gst';

    /**
     * Constant for value 'key'
     * @return string 'key'
     */
    protected const KEY = 'key';

    /**
     * Constant for value 'pub'
     * @return string 'pub'
     */
    protected const PUB = 'pub';

    /**
     * Constant for value 'email'
     * @return string 'email'
     */
    protected const EMAIL = 'email';
}
