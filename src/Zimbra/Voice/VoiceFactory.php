<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice;

/**
 * Voice soap api factory class
 * 
 * @package   Zimbra
 * @category  Mail
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class VoiceFactory
{
    /**
     * @var array
     */
    private static $_instances = array();

    /**
     * Creates a singleton of a VoiceInterface base on parameters.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  string $client   Soap client
     * @return VoiceInterface
     */
    public static function instance($location = 'https://localhost/service/soap', $client = 'http')
    {
        $key = sha1($location.$client);
        if (isset(self::$_instances[$key]) and (self::$_instances[$key] instanceof VoiceInterface))
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
     * Returns a new VoiceInterface object.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  string $client   Soap client
     * @return VoiceInterface
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
