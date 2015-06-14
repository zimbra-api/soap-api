<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account;

use Zimbra\Enum\RequestFormat;

/**
 * Account is a class which allows to manage account in Zimbra
 * 
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class AccountFactory
{
    /**
     * @var array
     */
    private static $_instances = [];

    /**
     * Creates a singleton of a AccountInterface base on parameters.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  RequestFormat $format The request format.
     * @return AccountInterface
     */
    public static function instance($location = 'https://localhost/service/soap', RequestFormat $format = null)
    {
        $key = sha1($location);
        if (isset(self::$_instances[$key]) and (self::$_instances[$key] instanceof AccountInterface))
        {
            return self::$_instances[$key];
        }
        else
        {
            self::$_instances[$key] = self::factory($location, $format);
            return self::$_instances[$key];
        }
    }

    /**
     * Returns a new AccountInterface object.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  RequestFormat $format The request format.
     * @return AccountInterface
     */
    public static function factory($location = 'https://localhost/service/soap', RequestFormat $format = null)
    {
        return new Http($location, $format);
    }
}
