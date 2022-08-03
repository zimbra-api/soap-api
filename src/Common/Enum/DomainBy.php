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
 * DomainBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DomainBy extends NameIdBy
{
    /**
     * Constant for value 'virtualHostname'
     * @return string 'virtualHostname'
     */
    protected const VIRTUAL_HOSTNAME = 'virtualHostname';

    /**
     * Constant for value 'krb5Realm'
     * @return string 'krb5Realm'
     */
    protected const KRB5_REALM = 'krb5Realm';

    /**
     * Constant for value 'foreignName'
     * @return string 'foreignName'
     */
    protected const FOREIGN_NAME = 'foreignName';
}
