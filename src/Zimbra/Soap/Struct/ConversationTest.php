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

/**
 * ConversationTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConversationTest extends FilterTest
{
    /**
     * Where
     * @var string
     */
    private $_where;

    /**
     * Constructor method for ConversationTest
     * @param int $index
     * @param string $where
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index, $where = null, $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_where = trim($where);
    }

    /**
     * Gets or sets where
     *
     * @param  string $where
     * @return string|self
     */
    public function where($where = null)
    {
        if(null === $where)
        {
            return $this->_where;
        }
        $this->_where = trim($where);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'conversationTest')
    {
        $name = !empty($name) ? $name : 'conversationTest';
        $arr = parent::toArray($name);
        if(!empty($this->_where))
        {
            $arr[$name]['where'] = $this->_where;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'conversationTest')
    {
        $name = !empty($name) ? $name : 'conversationTest';
        $xml = parent::toXml($name);
        if(!empty($this->_where))
        {
            $xml->addAttribute('where', $this->_where);
        }
        return $xml;
    }
}
