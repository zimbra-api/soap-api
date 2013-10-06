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
use Zimbra\Soap\Struct\ConstraintAttr as Attr;

/**
 * ModifyDelegatedAdminConstraints class
 * Modify constraint (zimbraConstraint) for delegated admin on global config or a COS.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyDelegatedAdminConstraints extends Request
{
    /**
     * Target type
     * @var string
     */
    private $_type;

    /**
     * Id
     * @var string
     */
    private $_id;

    /**
     * Name
     * @var string
     */
    private $_name;

    /**
     * Constaint attributes
     * @var array
     */
    private $_attrs = array();

    /**
     * Constructor method for ModifyDelegatedAdminConstraints
     * @param string $type
     * @param string $id
     * @param string $name
     * @param array  $attrs
     * @return self
     */
    public function __construct($type, $id = null, $name = null, array $attrs = array())
    {
        parent::__construct();
        if(TargetType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid target type');
        }
        $this->_id = trim($id);
        $this->_name = trim($name);
        $this->attrs($attrs);
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        if(TargetType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid target type');
        }
        return $this;
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
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
     * Add an attr
     *
     * @param  Attr $attr
     * @return ModifyDelegatedAdminConstraints
     */
    public function addAttr(Attr $attr)
    {
        $this->_attrs[] = $attr;
        return $this;
    }

    /**
     * Gets or sets attrs
     *
     * @param  array $attrs
     * @return array|self
     */
    public function attrs(array $attrs = null)
    {
        if(null === $attrs)
        {
            return $this->_attrs;
        }
        $this->_attrs = array();
        foreach ($attrs as $attr)
        {
            if($attr instanceof Attr)
            {
                $this->_attrs[] = $attr;
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
        $this->array = array(
            'type' => $this->_type,
        );
        if(!empty($this->_id))
        {
            $this->array['id'] = $this->_id;
        }
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
        }
        if(count($this->_attrs))
        {
            $this->array['a'] = array();
            foreach ($this->_attrs as $attr)
            {
                $attrArr = $attr->toArray('a');
                $this->array['a'][] = $attrArr['a'];
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
        $this->xml->addAttribute('type', $this->_type);
        if(!empty($this->_id))
        {
            $this->xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_name))
        {
            $this->xml->addAttribute('name', $this->_name);
        }
        foreach ($this->_attrs as $attr)
        {
            $this->xml->append($attr->toXml('a'));
        }
        return parent::toXml();
    }
}
