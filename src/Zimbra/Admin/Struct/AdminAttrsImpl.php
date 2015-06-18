<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;
use Zimbra\Struct\KeyValuePair;

/**
 * AdminAttrsImpl struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class AdminAttrsImpl extends Base
{
    /**
     * Attributes
     * @var TypedSequence<KeyValuePair>
     */
    private $_attrs;

    /**
     * Constructor method for AdminAttrsImpl
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = array())
    {
        parent::__construct();
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
     * Add an attr
     *
     * @param  KeyValuePair $attr
     * @return self
     */
    public function addAttr(KeyValuePair $attr)
    {
        $this->_attrs->add($attr);
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->_attrs = new TypedSequence('Zimbra\Struct\KeyValuePair', $attrs);
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @param array $attrs
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
    public function toArray($name = 'attrs')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attrs')
    {
        return parent::toXml($name);
    }
}
