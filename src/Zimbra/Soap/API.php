<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

/**
 * API is a base class which allows to manage Zimbra api
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class API
{
    /**
     * The Zimbra api soap location
     * @var string
     */
    protected $_location = 'https://localhost/service/soap';

    /**
     * Zimbra api soap client
     * @var ClientInterface
     */
    protected $_client;

    /**
     * The soap namespace
     * @var string
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
