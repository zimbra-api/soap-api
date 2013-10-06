<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\NamedElement as Provider;

/**
 * PurgeFreeBusyQueue class
 * Purges the queue for the given freebusy provider on the current host.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class PurgeFreeBusyQueue extends Request
{
    /**
     * Provider information
     * @var Provider
     */
    private $_provider;

    /**
     * Constructor method for PurgeFreeBusyQueue
     * @param Provider $provider
     * @return self
     */
    public function __construct(Provider $provider = null)
    {
        parent::__construct();
        if($provider instanceof Provider)
        {
            $this->_provider = $provider;
        }
    }

    /**
     * Gets or sets Provider
     *
     * @param  Provider $provider
     * @return Provider|self
     */
    public function provider(Provider $provider = null)
    {
        if(null === $provider)
        {
            return $this->_provider;
        }
        $this->_provider = $provider;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_provider instanceof Provider)
        {
            $this->array = $this->_provider->toArray('provider');
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_provider instanceof Provider)
        {
            $this->xml->append($this->_provider->toXml('provider'));
        }
        return parent::toXml();
    }
}
