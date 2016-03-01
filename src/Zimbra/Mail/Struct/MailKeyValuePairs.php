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
use Zimbra\Struct\Base;
use Zimbra\Struct\KeyValuePair;

/**
 * MailKeyValuePairs struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailKeyValuePairs extends Base
{
    /**
     * Key value pairs
     * @var TypedSequence<KeyValuePair>
     */
    private $_pairs = array();

    /**
     * Constructor method for MailKeyValuePairs
     * @param array $a Key value pairs
     * @return self
     */
    public function __construct(array $pairs = [])
    {
        parent::__construct();
        $this->setKeyValuePairs($pairs);
        $this->on('before', function(Base $sender)
        {
            if($sender->getKeyValuePairs()->count())
            {
                $sender->setChild('a', $sender->getKeyValuePairs()->all());
            }
        });
    }

    /**
     * Add key value pair
     *
     * @param  KeyValuePair $pair
     * @return self
     */
    public function addKeyValuePair(KeyValuePair $pair)
    {
        $this->_pairs->add($pair);
        return $this;
    }

    /**
     * Sets key value pair sequence
     *
     * @param  array $pairs
     * @return self
     */
    public function setKeyValuePairs(array $pairs)
    {
        $this->_pairs = new TypedSequence('Zimbra\Struct\KeyValuePair', $pairs);
        return $this;
    }

    /**
     * Gets key value pair sequence
     *
     * @return Sequence
     */
    public function getKeyValuePairs()
    {
        return $this->_pairs;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'kpv')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'kpv')
    {
        return parent::toXml($name);
    }
}
