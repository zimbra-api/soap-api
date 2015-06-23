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

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\NamedElement;

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
class GetDelegatedAdminConstraints extends Base
{
    /**
     * Attributes
     * @var array
     */
    private $_attrs;

    /**
     * Constructor method for GetDelegatedAdminConstraints
     * @param  TargetType $type Target type
     * @param  string $id ID
     * @param  string $name Name
     * @param  array $attrs Attributes
     * @return self
     */
    public function __construct(TargetType $type, $id = null, $name = null, array $attrs = [])
    {
        parent::__construct();
        $this->setProperty('type', $type);
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        $this->setAttrs($attrs);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAttrs()->count())
            {
                $sender->setChild('a', $sender->getAttrs()->all());
            }
        });
    }

    /**
     * Gets type
     *
     * @return TargetType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  TargetType $type
     * @return self
     */
    public function setType(TargetType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Add an attr
     *
     * @param  NamedElement $attr
     * @return self
     */
    public function addAttr(NamedElement $attr)
    {
        $this->_attrs->add($attr);
        return $this;
    }

    /**
     * Sets attr sequence
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->_attrs = new TypedSequence('Zimbra\Struct\NamedElement', $attrs);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }
}
