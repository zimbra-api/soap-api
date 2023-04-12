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
 * GalMode enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum GalMode: string
{
    /**
     * Constant for value 'both'
     * @return string 'both'
     */
    case BOTH = 'both';

    /**
     * Constant for value 'ldap'
     * @return string 'ldap'
     */
    case LDAP = 'ldap';

    /**
     * Constant for value 'zimbra'
     * @return string 'zimbra'
     */
    case ZIMBRA = 'zimbra';
}
