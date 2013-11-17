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
use Zimbra\Soap\Struct\NamedElement as Attr;
use Zimbra\Soap\Enum\TargetType;
use Zimbra\Utils\TypedSequence;

/**
 * GetDelegatedAdminConstraints class
 * Get constraints (zimbraConstraint) for delegated admin on global config or a COS 
 * none or several attributes can be specified for which constraints are to be returned. 
 * If no attribute is specified, all constraints on the global config/cos will be returned. 
 * If there is no constraint for a requested attribute, <a> element for the attribute will not appear in the response. 
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDelegatedAdminConstraints extends Request
{
    /**
     * Target type
     * @var TargetType
     */
    private $_type;

    /**
     * ID
     * @var string
     */
    private $_id;
    /**
     * Name
     * @var string
     */
    private $_name;

    /**
     * Attributes
     * @var array
     */
    private $_attrs = array();

    /**
     * Constructor method for GetDelegatedAdminConstraints
     * @param  TargetType $type
     * @param  string $id
     * @param  string $name
     * @param  array $attrs
     * @return self
     */
    public function __construct(TargetType $type, $id = null, $name = null, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->_type = $type;
		$this->_id = trim($id);
		$this->_name = trim($name);
        $this->_attrs = new TypedSequence('Zimbra\Soap\Struct\NamedElement', $attrs);
    }

    /**
     * Gets or sets type
     *
     * @param  TargetType $type
     * @return TargetType|self
     */
    public function type(TargetType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
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
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attrs->add($attr);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function attrs()
    {
        return $this->_attrs;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'type' => $this->_type
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
