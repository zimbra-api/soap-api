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
 * DomainBy class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DomainBy
{
    /**
     * Constant for value 'id'
     * @return string 'id'
     */
    const ID = 'id';

    /**
     * Constant for value 'name'
     * @return string 'name'
     */
    const NAME = 'name';

    /**
     * Constant for value 'virtualHostname'
     * @return string 'virtualHostname'
     */
    const VIRTUAL_HOSTNAME = 'virtualHostname';

    /**
     * Constant for value 'krb5Realm'
     * @return string 'krb5Realm'
     */
    const KRB5_REALM = 'krb5Realm';

    /**
     * Constant for value 'foreignName'
     * @return string 'foreignName'
     */
    const FOREIGN_NAME = 'foreignName';

    /**
     * Return true if value is allowed
     * @param  string $by
     * @return bool true|false
     */
    public static function isValid($by)
    {
        $validValues = array(
            self::ID,
            self::NAME,
            self::VIRTUAL_HOSTNAME,
            self::KRB5_REALM,
            self::FOREIGN_NAME,
        );
        return in_array($by, $validValues);
    }
}
