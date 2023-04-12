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
 * CacheType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum CacheType: string
{
    /**
     * Constant for value 'skin'
     * @return string 'skin'
     */
    case ALL = 'all';

    /**
     * Constant for value 'skin'
     * @return string 'skin'
     */
    case SKIN = 'skin';

    /**
     * Constant for value 'locale'
     * @return string 'locale'
     */
    case LOCALE = 'locale';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    case ACCOUNT = 'account';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    case COS = 'cos';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    case DOMAIN = 'domain';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    case SERVER = 'server';

    /**
     * Constant for value 'zimlet'
     * @return string 'zimlet'
     */
    case ZIMLET = 'zimlet';
}
