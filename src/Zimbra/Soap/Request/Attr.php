<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Request;

use Zimbra\Soap\Request;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Common\TypedSequence;

/**
 * Attr class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Attr extends Request
{
    /**
     * Attributes specified as key value pairs
     * @var Sequence
     */
    private $_attrs;

    /**
     * Attr request constructor
     * @param array  $attrs
     * @return self
     */
    public function __construct(array $attrs = [])
    {
        parent::__construct();
        $this->setAttrs($attrs);

        $this->on('before', function(Request $sender)
        {
            if($sender->getAttrs()->count())
            {
                $sender->setChild('a', $sender->getAttrs()->all());
            }
        });
    }

    /**
     * Add an attribute
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
     * @param array  $attrs
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
     * @return Sequence
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }
}
