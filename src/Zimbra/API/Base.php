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

/**
 * Base is a base class which allows to manage Zimbra
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Base
{
    /**
     * @var string The Zimbra api soap location
     */
    protected $_location = 'https://localhost/service/soap';

    /**
     * @var ClientInterface Zimbra api soap client
     */
    protected $_client;

    /**
     * @var string The soap namespace
     */
    protected $_namespace = 'urn:zimbra';

    /**
     * Get Zimbra api soap client.
     *
     * @return ClientInterface
     */
    public function client()
    {
        return $this->_client;
    }

    /**
     * Get Zimbra api soap location.
     *
     * @return string
     */
    public function location()
    {
        return $this->_location;
    }
}
