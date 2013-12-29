<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\ContactAction;
use Zimbra\Utils\TypedSequence;

/**
 * ContactActionSelector struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
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
     * @param ContactAction $op
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
     * @return self
     */
    public function __construct(
        ContactAction $op,
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
        $this->_a = new TypedSequence('Zimbra\Soap\Struct\NewContactAttr', $a);
    }

    /**
     * Gets or sets op
     *
     * @param  ContactAction $op
     * @return ContactAction|self
     */
    public function op(ContactAction $op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
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
        $name = !empty($name) ? $name : 'action';
        $arr = parent::toArray($name);
        if(count($this->_a))
        {
            $arr[$name]['a'] = array();
            foreach ($this->_a as $a)
            {
                $aArr = $a->toArray('a');
                $arr[$name]['a'][] = $aArr['a'];
            }
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $xml = parent::toXml($name);
        foreach ($this->_a as $a)
        {
            $xml->append($a->toXml('a'));
        }
        return $xml;
    }
}
