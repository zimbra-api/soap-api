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
 * DiffDocumentVersionSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DiffDocumentVersionSpec
{
    /**
     * ID.
     * @var string
     */
    private $_id;

    /**
     * Revision 1.
     * @var int
     */
    private $_v1;

    /**
     * Revision 2.
     * @var int
     */
    private $_v2;

    /**
     * Constructor method for AccountACEInfo
     * @param string $id
     * @param int $v1
     * @param int $v2
     * @return self
     */
    public function __construct(
        $id = null,
        $v1 = null,
        $v2 = null
    )
    {
        $this->_id = trim($id);
        if(null !== $v1)
        {
            $this->_v1 = (int) $v1;
        }
        if(null !== $v2)
        {
            $this->_v2 = (int) $v2;
        }
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
     * Gets or sets v1
     *
     * @param  int $v1
     * @return int|self
     */
    public function v1($v1 = null)
    {
        if(null === $v1)
        {
            return $this->_v1;
        }
        $this->_v1 = (int) $v1;
        return $this;
    }

    /**
     * Gets or sets v2
     *
     * @param  int $v2
     * @return int|self
     */
    public function v2($v2 = null)
    {
        if(null === $v2)
        {
            return $this->_v2;
        }
        $this->_v2 = (int) $v2;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'doc')
    {
        $name = !empty($name) ? $name : 'doc';
        $arr = array();
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(is_int($this->_v1))
        {
            $arr['v1'] = $this->_v1;
        }
        if(is_int($this->_v2))
        {
            $arr['v2'] = $this->_v2;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'doc')
    {
        $name = !empty($name) ? $name : 'doc';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(is_int($this->_v1))
        {
            $xml->addAttribute('v1', $this->_v1);
        }
        if(is_int($this->_v2))
        {
            $xml->addAttribute('v2', $this->_v2);
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
