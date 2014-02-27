<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;
use Zimbra\Struct\KeyValuePair;

/**
 * AccountKeyValuePairs struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class AccountKeyValuePairs extends Base
{
    /**
     * Attributes
     * @var TypedSequence<KeyValuePair>
     */
    private $_attr;

    /**
     * Constructor method for AccountKeyValuePairs
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = array())
    {
        parent::__construct();
        $this->_attr = new TypedSequence('Zimbra\Struct\KeyValuePair', $attrs);

        $this->on('before', function(Base $sender)
        {
            if($sender->attr()->count())
            {
                $sender->child('a', $sender->attr()->all());
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
