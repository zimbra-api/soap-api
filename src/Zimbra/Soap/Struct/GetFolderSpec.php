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
 * GetFolderSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetFolderSpec
{
    /**
     * Base folder UUID
     * @var string
     */
    private $_uuid;

    /**
     * Base folder ID
     * @var string
     */
    private $_l;

    /**
     * Fully qualified path
     * @var string
     */
    private $_path;

    /**
     * Constructor method for GetFolderSpec
     * @param string $uuid
     * @param string $l
     * @param string $path
     * @return self
     */
    public function __construct(
        $uuid = null,
        $l = null,
        $path = null
    )
    {
        $this->_uuid = trim($uuid);
        $this->_l = trim($l);
        $this->_path = trim($path);
    }

    /**
     * Gets or sets uuid
     *
     * @param  string $uuid
     * @return string|self
     */
    public function uuid($uuid = null)
    {
        if(null === $uuid)
        {
            return $this->_uuid;
        }
        $this->_uuid = trim($uuid);
        return $this;
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'folder')
    {
        $name = !empty($name) ? $name : 'folder';
        if(!empty($this->_uuid))
        {
            $arr['uuid'] = $this->_uuid;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(!empty($this->_path))
        {
            $arr['path'] = $this->_path;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'folder')
    {
        $name = !empty($name) ? $name : 'folder';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_uuid))
        {
            $xml->addAttribute('uuid', $this->_uuid);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        if(!empty($this->_path))
        {
            $xml->addAttribute('path', $this->_path);
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
