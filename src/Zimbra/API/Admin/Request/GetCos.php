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
 * GetCos class
 * Get Class Of Service (COS).
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCos extends Request
{
    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Specify Class Of Service (COS)
     * @var Cos
     */
    private $_cos;

    /**
     * Constructor method for GetCos
     * @param  Cos $cos
     * @param  string $attrs
     * @return self
     */
    public function __construct(Cos $cos = null, $attrs = null)
    {
        parent::__construct();
        if($cos instanceof Cos)
        {
            $this->_cos = $cos;
        }
        $this->_attrs = trim($attrs);
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
        if($this->_cos instanceof Cos)
        {
            $this->array += $this->_cos->toArray();
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
        if($this->_cos instanceof Cos)
        {
            $this->xml->append($this->_cos->toXml());
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
