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
 * GalMode enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GalMode extends Base
{
    /**
     * Constant for value 'both'
     * @return string 'both'
     */
    const BOTH = 'both';

    /**
     * Constant for value 'ldap'
     * @return string 'ldap'
     */
    const LDAP = 'ldap';

    /**
     * Constant for value 'zimbra'
     * @return string 'zimbra'
     */
    const ZIMBRA = 'zimbra';
}
