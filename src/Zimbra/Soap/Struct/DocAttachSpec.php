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
 * DocAttachSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocAttachSpec extends AttachSpec
{
    /**
     * Document path. If specified "id" and "ver" attributes are ignored
     * @var string
     */
    private $_path;

    /**
     * Item ID
     * @var string
     */
    private $_id;

    /**
     * Optional Version.
     * @var int
     */
    private $_ver;

    /**
     * Constructor method for DocAttachSpec
     * @param  string $path
     * @param  string $id
     * @param  int $ver
     * @param  bool $optional
     * @return self
     */
    public function __construct($path = null, $id = null, $ver = null, $optional = null)
    {
        parent::__construct($optional);
        $this->_path = trim($path);
        $this->_id = trim($id);
        if(null !== $ver)
        {
            $this->_ver = (int) $ver;
        }
    }

    /**
     * Gets or sets path
     *
     * @param  string $path
     * @return string|self
     */
    public function path($path = null)
    {
        if(null === $path)
        {
            return $this->_path;
        }
        $this->_path = trim($path);
        return $this;
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
     * Gets or sets ver
     *
     * @param  int $ver
     * @return int|self
     */
    public function ver($ver = null)
    {
        if(null === $ver)
        {
            return $this->_ver;
        }
        $this->_ver = (int) $ver;
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
        if(!empty($this->_path))
        {
            $arr['path'] = $this->_path;
        }
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(is_int($this->_ver))
        {
            $arr['ver'] = $this->_ver;
        }
        if(is_bool($this->_optional))
        {
            $arr['optional'] = $this->_optional ? 1 : 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'doc')
    {
        $name = !empty($name) ? $name : 'doc';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_path))
        {
            $xml->addAttribute('path', $this->_path);
        }
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(is_int($this->_ver))
        {
            $xml->addAttribute('ver', $this->_ver);
        }
        if(is_bool($this->_optional))
        {
            $xml->addAttribute('optional', $this->_optional ? 1 : 0);
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
