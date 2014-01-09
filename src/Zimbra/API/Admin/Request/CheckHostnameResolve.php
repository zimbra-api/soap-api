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

/**
 * CheckHostnameResolve class
 * Check whether a hostname can be resolved.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckHostnameResolve extends Request
{
    /**
     * The hostname
     * @var string
     */
    private $_hostname;

    /**
     * Constructor method for CheckHostnameResolve
     *
     * @param string $action
     * @return self
     */
    public function __construct($hostname = null)
    {
        parent::__construct();
        $this->_hostname = trim($hostname);
    }

    /**
     * Gets or sets hostname
     *
     * @param  string $hostname
     * @return string|self
     */
    public function hostname($hostname = null)
    {
        if(null === $hostname)
        {
            return $this->_hostname;
        }
        $this->_hostname = trim($hostname);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array();
        if(!empty($this->_hostname))
        {
            $this->array['hostname'] = $this->_hostname;
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
        if(!empty($this->_hostname))
        {
            $this->xml->addAttribute('hostname', $this->_hostname);
        }
        return parent::toXml();
    }
}
