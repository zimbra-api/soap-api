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
    private $_a;

    /**
     * Constructor method for AccountACEInfo
     * @param ContactActionOp $op
     * @param string $id
     * @param string $tcon
     * @param int    $tag
     * @param string $l
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $f
     * @param string $t
     * @param string $tn
     * @param array $a
     * @return self
     */
    public function __construct(
        ContactActionOp $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $l = null,
        $rgb = null,
        $color = null,
        $name = null,
        $f = null,
        $t = null,
        $tn = null,
        array $a = array()
    )
    {
        parent::__construct(
            $op,
            $id,
            $tcon,
            $tag,
            $l,
            $rgb,
            $color,
            $name,
            $f,
            $t,
            $tn
        );
        $this->_a = new TypedSequence('Zimbra\Mail\Struct\NewContactAttr', $a);

        $this->on('before', function(ActionSelector $sender)
        {
            if($sender->a()->count())
            {
                $sender->child('a', $sender->a()->all());
            }
        });
    }

    /**
     * Gets or sets op
     *
     * @param  ContactActionOp $op
     * @return ContactActionOp|self
     */
    public function op(ContactActionOp $op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        return $this->property('op', $op);
    }

    /**
     * Add a new contact attribute
     *
     * @param  NewContactAttr $a
     * @return self
     */
    public function addA(NewContactAttr $a)
    {
        $this->_a->add($a);
        return $this;
    }

    /**
     * Gets new contact attribute sequence
     *
     * @return Sequence
     */
    public function a()
    {
        return $this->_a;
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
