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

use Zimbra\Enum\RequestFormat;

/**
 * Voice soap api factory class
 * 
 * @package   Zimbra
 * @category  Voice
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class VoiceFactory
{
    /**
     * @var array
     */
    private static $_instances = [];

    /**
     * Creates a singleton of a VoiceInterface base on parameters.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  RequestFormat $format The request format.
     * @return VoiceInterface
     */
    public static function instance($location = 'https://localhost/service/soap', RequestFormat $format = null)
    {
        $key = sha1($location);
        if (isset(self::$_instances[$key]) and (self::$_instances[$key] instanceof VoiceInterface))
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
     * Returns a new VoiceInterface object.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  RequestFormat $format The request format.
     * @return VoiceInterface
     */
    public static function factory($location = 'https://localhost/service/soap', RequestFormat $format = null)
    {
        return new Http($location, $format);
    }
}
