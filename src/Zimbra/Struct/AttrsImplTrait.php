<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use Zimbra\Common\TypedSequence;

/**
 * AttrsImpl struct class
 * 
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
trait AttrsImplTrait
{
    /**
     * Attributes
     * @var TypedSequence<KeyValuePair>
     */
    private $_attrs;

    /**
     * Constructor method for AttrsImpl
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = [])
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
}
