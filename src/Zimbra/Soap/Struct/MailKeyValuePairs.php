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

use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;

/**
 * MailKeyValuePairs class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailKeyValuePairs
{
    /**
     * Key value pairs
     * @var TypedSequence<KeyValuePair>
     */
    private $_a = array();

    /**
     * Constructor method for MailKeyValuePairs
     * @param array $a
     * @return self
     */
    public function __construct(array $a = array())
    {
        $this->_a = new TypedSequence('Zimbra\Soap\Struct\KeyValuePair', $a);
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
        $name = !empty($name) ? $name : 'kpv';
        $arr = array();
        if(count($this->_a))
        {
            $arr['a'] = array();
            foreach ($this->_a as $a)
            {
                $aArr = $a->toArray('a');
                $arr['a'][] = $aArr['a'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'kpv')
    {
        $name = !empty($name) ? $name : 'kpv';
        $xml = new SimpleXML('<'.$name.' />');
        foreach ($this->_a as $a)
        {
            $xml->append($a->toXml('a'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
