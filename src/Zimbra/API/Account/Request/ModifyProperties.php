<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\Prop;

/**
 * ModifyProperties class
 * Modify properties related to zimlets
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyProperties extends Request
{
    /**
     * Specify the properences to be modified
     * @var array
     */
    private $_props = array();

    /**
     * Constructor method for ModifyProperties
     * @param array $props
     * @return self
     */
    public function __construct(array $props = array())
    {
        parent::__construct();
        $this->props($props);
    }

    /**
     * Add a prop
     *
     * @param  Pref $prop
     * @return self
     */
    public function addProp(Prop $prop)
    {
        $this->_props[] = $prop;
        return $this;
    }

    /**
     * Gets or sets props
     *
     * @param  array $props
     * @return array|self
     */
    public function props(array $props = null)
    {
        if(null === $props)
        {
            return $this->_props;
        }
        $this->_props = array();
        foreach ($props as $prop)
        {
            if($prop instanceof Prop)
            {
                $this->_props[] = $prop;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_props))
        {
            $this->array['prop'] = array();
            foreach ($this->_props as $prop)
            {
                $propArr = $prop->toArray();
                $this->array['prop'][] = $propArr['prop'];
            }
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
        foreach ($this->_props as $prop)
        {
            $this->xml->append($prop->toXml());
        }
        return parent::toXml();
    }
}
