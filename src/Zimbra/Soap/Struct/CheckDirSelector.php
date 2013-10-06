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
 * CheckDirSelector class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckDirSelector
{
    /**
     * Full path to the directory
     * @var string
     */
    private $_path;

    /**
     * Whether to create the directory or not if it doesn't exist
     * @var bool
     */
    private $_create;

    /**
     * Constructor method for CheckDirSelector
     * @param string $path
     * @param bool $create
     * @return self
     */
    public function __construct($path, $create = null)
    {
        $this->_path = trim($path);
        if(null !== $create)
        {
            $this->_create = (bool) $create;
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
     * Gets or sets create
     *
     * @param  bool $create
     * @return bool|self
     */
    public function create($create = null)
    {
        if(null === $create)
        {
            return $this->_create;
        }
        $this->_create = (bool) $create;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'directory')
    {
        $name = !empty($name) ? $name : 'directory';
        $arr = array(
            'path' => $this->_path,
        );
        if(is_bool($this->_create))
        {
            $arr['create'] = $this->_create ? 1 : 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'directory')
    {
        $name = !empty($name) ? $name : 'directory';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('path', $this->_path);
        if(is_bool($this->_create))
        {
            $xml->addAttribute('create', $this->_create ? 1 : 0);
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
