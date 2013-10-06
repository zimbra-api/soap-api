<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API;

use Zimbra\API\Account\AccountInterface;
use Zimbra\API\Account\Http;
use Zimbra\API\Account\Wsdl;

/**
 * Account is a class which allows to manage account in Zimbra
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Account extends Base
{
    /**
     * @var array
     */
    private static $_instances = array();

    /**
     * Creates a singleton of a AccountInterface base on parameters.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  string $client   Soap client
     * @return AccountInterface
     */
    public static function instance($location = 'https://localhost/service/soap', $client = 'http')
    {
        $key = md5($location.$client);
        if (isset(self::$_instances[$key]) and (self::$_instances[$key] instanceof AccountInterface))
        {
            return self::$_instances[$key];
        }
        else
        {
            self::$_instances[$key] = self::factory($location, $client);
            return self::$_instances[$key];            
        }
    }

    /**
     * Returns a new AccountInterface object.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  string $client   Soap client
     * @return AccountInterface
     */
    public static function factory($location = 'https://localhost/service/soap', $client = 'http')
    {
        switch (strtolower($client))
        {
            case 'wsdl':
                return new Wsdl($location);
            default:
                return new Http($location);
        }
    }
}
