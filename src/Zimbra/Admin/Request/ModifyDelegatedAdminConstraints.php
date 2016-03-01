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

use Zimbra\Admin\Struct\ConstraintAttr as Attr;
use Zimbra\Common\TypedSequence;
use Zimbra\Enum\TargetType;

/**
 * ModifyDelegatedAdminConstraints request class
 * Modify constraint (zimbraConstraint) for delegated admin on global config or a COS.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyDelegatedAdminConstraints extends Base
{
    /**
     * Constaint attributes
     * @var array
     */
    private $_attrs;

    /**
     * Constructor method for ModifyDelegatedAdminConstraints
     * @param TargetType $type Target type
     * @param string $id Id
     * @param string $name Name
     * @param array  $attrs Constaint attributes
     * @return self
     */
    public function __construct(
        TargetType $type,
        $id = null,
        $name = null,
        array $attrs = []
    )
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
        $this->_attrs = new TypedSequence('Zimbra\Admin\Struct\ConstraintAttr', $attrs);

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
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra ID
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
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attrs->add($attr);
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @param array  $attrs
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->_attrs = new TypedSequence('Zimbra\Admin\Struct\ConstraintAttr', $attrs);
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @return Sequence
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }
}
