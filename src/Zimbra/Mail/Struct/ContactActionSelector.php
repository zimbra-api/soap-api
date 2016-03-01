<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\ContactActionOp;

/**
 * ContactActionSelector struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ContactActionSelector extends ActionSelector
{
    /**
     * New Contact attributes
     * @var TypedSequence<NewContactAttr>
     */
    private $_attrs;

    /**
     * Constructor method for AccountACEInfo
     * @param ContactActionOp $op
     * @param string $id
     * @param string $tcon
     * @param int    $tag
     * @param string $folder
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $flags
     * @param string $tags
     * @param string $tagNames
     * @param array $attrs
     * @return self
     */
    public function __construct(
        ContactActionOp $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $folder = null,
        $rgb = null,
        $color = null,
        $name = null,
        $flags = null,
        $tags = null,
        $tagNames = null,
        array $attrs = []
    )
    {
        parent::__construct(
            $op,
            $id,
            $tcon,
            $tag,
            $folder,
            $rgb,
            $color,
            $name,
            $flags,
            $tags,
            $tagNames
        );

        $this->setAttrs($attrs);
        $this->on('before', function(ActionSelector $sender)
        {
            if($sender->getAttrs()->count())
            {
                $sender->setChild('a', $sender->getAttrs()->all());
            }
        });
    }

    /**
     * Gets operation
     *
     * @return ContactActionOp
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  ContactActionOp $op
     * @return self
     */
    public function setOperation(ContactActionOp $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Add a new contact attribute
     *
     * @param  NewContactAttr $a
     * @return self
     */
    public function addAttr(NewContactAttr $a)
    {
        $this->_attrs->add($a);
        return $this;
    }

    /**
     * Sets new contact attribute sequence
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->_attrs = new TypedSequence('Zimbra\Mail\Struct\NewContactAttr', $attrs);
        return $this;
    }

    /**
     * Gets new contact attribute sequence
     *
     * @return Sequence
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
