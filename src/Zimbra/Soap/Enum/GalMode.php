<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Enum;

/**
 * GalMode class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GalMode
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

    /**
     * Return true if value is allowed
     * @param  string $mode
     * @return bool true|false
     */
    public static function isValid($mode)
    {
        $validValues = array(
            self::BOTH,
            self::LDAP,
            self::ZIMBRA,
        );
        return in_array($mode, $validValues);
    }
}
