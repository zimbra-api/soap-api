<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra;

/**
 * General utility class in Zimbra API PHP, not to be instantiated.
 * 
 * @package ZAP
 * 
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class API
{
    /**
     * Creates an instance of a Zimbra\API\Account\Interface base on parameters.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  string $client   Soap client
     * @return Zimbra\API\Account\Interface
     */
    public static function account($location, $client = null)
    {
    }

    /**
     * Creates an instance of a Zimbra\API\Admin\Interface base on parameters.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  string $client   Soap client
     * @return Zimbra\API\Admin\Interface
     */
    public static function admin($location, $client = null)
    {
    }

    /**
     * Creates an instance of a Zimbra\API\Account\Interface base on parameters.
     *
     * @param  string $location The Zimbra api soap location.
     * @param  string $client   Soap client
     * @return Zimbra\API\Mail\Interface
     */
    public static function mail($location, $client = null)
    {
    }
}
