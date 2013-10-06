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
use Zimbra\Soap\Struct\UCServiceSelector as UCService;

/**
 * GetUCService class
 * Get UC Service.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetUCService extends Request
{
    /**
     * UC Service
     * @var UCService
     */
    private $_ucservice;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Constructor method for GetUCService
     * @param  UCService $ucservice
     * @param  string $attrs
     * @return self
     */
    public function __construct(UCService $ucservice = null, $attrs = null)
    {
        parent::__construct();
        if($ucservice instanceof UCService)
        {
            $this->_ucservice = $ucservice;
        }
		$this->_attrs = trim($attrs);
    }

    /**
     * Gets or sets ucservice
     *
     * @param  UCService $ucservice
     * @return UCService|self
     */
    public function ucservice(UCService $ucservice = null)
    {
        if(null === $ucservice)
        {
            return $this->_ucservice;
        }
        $this->_ucservice = $ucservice;
        return $this;
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->_attrs;
        }
        $this->_attrs = trim($attrs);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_ucservice instanceof UCService)
        {
            $this->array += $this->_ucservice->toArray();
        }
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
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
        if($this->_ucservice instanceof UCService)
        {
            $this->xml->append($this->_ucservice->toXml());
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
