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

use Zimbra\Soap\Client\ClientInterface;
use Zimbra\Soap\Request\Batch;

/**
 * API is a base class which allows to manage Zimbra api
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Api
{

    /**
     * Zimbra api soap client
     * @var ClientInterface
     */
    private $_client;

    public function __construct($location = 'https://localhost/service/soap')
    {
        $this->_client = new Client($location);
    }

    /**
     * Get Zimbra api soap client.
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Set Zimbra api soap client.
     *
     * @return self
     */
    public function setClient(ClientInterface $client)
    {
        $this->_client = $client;
        return $this;
    }

    /**
     * Perform a batch request.
     *
     * @param  array $requests
     * @return mix
     */
    public function batch(array $requests = [])
    {
        $request = new \Zimbra\Soap\Request\Batch(
            $requests
        );
        return $request->execute($this->getClient());
    }
}
