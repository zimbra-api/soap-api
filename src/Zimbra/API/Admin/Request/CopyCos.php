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
use Zimbra\Soap\Struct\CosSelector as Cos;

/**
 * CopyCos class
 * Copy Class of service (COS).
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CopyCos extends Request
{
    /**
     * Destination name for COS
     * @var string
     */
    private $_name;

    /**
     * Source COS
     * @var Cos
     */
    private $_cos;

    /**
     * Constructor method for CopyCos
     * @param string $name
     * @param Cos $cos
     * @return self
     */
    public function __construct($name = null, Cos $cos = null)
    {
        parent::__construct();
        $this->_name = trim($name);
        if($cos instanceof Cos)
        {
            $this->_cos = $cos;
        }
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets cos
     *
     * @param  Cos $cos
     * @return Cos|self
     */
    public function cos(Cos $cos = null)
    {
        if(null === $cos)
        {
            return $this->_cos;
        }
        $this->_cos = $cos;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
        }
        if($this->_cos instanceof Cos)
        {
            $this->array += $this->_cos->toArray();
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
        if(!empty($this->_name))
        {
            $this->xml->addChild('name', $this->_name);
        }
        if($this->_cos instanceof Cos)
        {
            $this->xml->append($this->_cos->toXml());
        }
        return parent::toXml();
    }
}
