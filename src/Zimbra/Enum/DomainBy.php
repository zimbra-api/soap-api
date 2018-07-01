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
 * DomainBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DomainBy extends NameIdBy
{
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
}
