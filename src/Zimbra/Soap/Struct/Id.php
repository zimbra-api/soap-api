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
 * Id class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Id
{
    /**
     * The id
     * @var string
     */
    private $_id;

    /**
     * Constructor method for id
     * @param  string $id
     * @return self
     */
    public function __construct($id = null)
    {
        $this->_id = trim($id);
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'id')
    {
        $name = !empty($name) ? $name : 'id';
        $arr = array();
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'id')
    {
        $name = !empty($name) ? $name : 'id';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
