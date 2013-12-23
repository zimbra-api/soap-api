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
use Zimbra\Utils\TypedSequence;

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
     * Specify the properties to be modified
     * @var TypedSequence
     */
    private $_prop;

    /**
     * Constructor method for ModifyProperties
     * @param array $prop
     * @return self
     */
    public function __construct(array $prop = array())
    {
        parent::__construct();
        $this->_prop = new TypedSequence('Zimbra\Soap\Struct\Prop', $prop);
    }

    /**
     * Add a prop
     *
     * @param  Pref $prop
     * @return self
     */
    public function addProp(Prop $prop)
    {
        $this->_prop->add($prop);
        return $this;
    }

    /**
     * Gets property sequence
     *
     * @return Sequence
     */
    public function prop()
    {
        return $this->_prop;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_prop))
        {
            $this->array['prop'] = array();
            foreach ($this->_prop as $prop)
            {
                $propArr = $prop->toArray('prop');
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
        foreach ($this->_prop as $prop)
        {
            $this->xml->append($prop->toXml('prop'));
        }
        return parent::toXml();
    }
}
