<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

/**
 * CacheType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CacheType extends Base
{
    /**
     * Constant for value 'skin'
     * @return string 'skin'
     */
    const SKIN = 'skin';

    /**
     * Constant for value 'locale'
     * @return string 'locale'
     */
    const LOCALE = 'locale';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    const ACCOUNT = 'account';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    const COS = 'cos';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    const DOMAIN = 'domain';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    const SERVER = 'server';

    /**
     * Constant for value 'zimlet'
     * @return string 'zimlet'
     */
    const ZIMLET = 'zimlet';
}