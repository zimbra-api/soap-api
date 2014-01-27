<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Enum\TargetType;
use Zimbra\Common\TypedSequence;
use Zimbra\Soap\Request;
use Zimbra\Struct\NamedElement as Attr;

/**
 * GetDelegatedAdminConstraints request class
 * Get constraints (zimbraConstraint) for delegated admin on global config or a COS 
 * none or several attributes can be specified for which constraints are to be returned. 
 * If no attribute is specified, all constraints on the global config/cos will be returned. 
 * If there is no constraint for a requested attribute, <a> element for the attribute will not appear in the response. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDelegatedAdminConstraints extends Request
{
    /**
     * Attributes
     * @var array
     */
    private $_attr = array();

    /**
     * Constructor method for GetDelegatedAdminConstraints
     * @param  TargetType $type Target type
     * @param  string $id ID
     * @param  string $name Name
     * @param  array $attr Attributes
     * @return self
     */
    public function __construct(TargetType $type, $id = null, $name = null, array $attr = array())
    {
        parent::__construct();
        $this->property('type', $type);
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        $this->_attr = new TypedSequence('Zimbra\Struct\NamedElement', $attr);

        $this->addHook(function($sender)
        {
            $sender->child('a', $sender->attr()->all());
        });
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
            return $this->property('type');
        }
        return $this->property('type', $type);
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
            return $this->property('id');
        }
        return $this->property('id', trim($id));
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
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attr->add($attr);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function attr()
    {
        return $this->_attr;
    }
}
