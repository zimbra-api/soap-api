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

use Zimbra\API\Admin\AccountInterface;
use Zimbra\API\Admin\Http;
use Zimbra\API\Admin\Wsdl;

/**
 * Admin is a class which allows to manage administration in Zimbra
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Admin extends Base
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
     * @return AdminInterface
     */
    public static function instance($location = 'https://localhost:7071/service/admin/soap', $client = 'http')
    {
        $key = md5($location.$client);
        if (isset(self::$_instances[$key]) and (self::$_instances[$key] instanceof AdminInterface))
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
     * Returns a new AdminInterface object.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  string $client   Soap client
     * @return AdminInterface
     */
    public static function factory($location = 'https://localhost:7071/service/admin/soap', $client = 'http')
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
