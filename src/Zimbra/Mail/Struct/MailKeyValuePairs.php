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
    private $_a = array();

    /**
     * Constructor method for MailKeyValuePairs
     * @param array $a Key value pairs
     * @return self
     */
    public function __construct(array $a = array())
    {
        parent::__construct();
        $this->_a = new TypedSequence('Zimbra\Struct\KeyValuePair', $a);

        $this->on('before', function(Base $sender)
        {
            if($sender->a()->count())
            {
                $sender->child('a', $sender->a()->all());
            }
        });
    }

    /**
     * Add key value pair
     *
     * @param  KeyValuePair $a
     * @return self
     */
    public function addA(KeyValuePair $a)
    {
        $this->_a->add($a);
        return $this;
    }

    /**
     * Gets key value pair sequence
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
