<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * CacheType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CacheType extends Enum
{
    /**
     * Constant for value 'skin'
     * @return string 'skin'
     */
    private const SKIN = 'skin';

    /**
     * Constant for value 'locale'
     * @return string 'locale'
     */
    private const LOCALE = 'locale';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    private const ACCOUNT = 'account';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    private const COS = 'cos';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    private const DOMAIN = 'domain';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    private const SERVER = 'server';

    /**
     * Constant for value 'zimlet'
     * @return string 'zimlet'
     */
    private const ZIMLET = 'zimlet';
}