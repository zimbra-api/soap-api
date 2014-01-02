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
 * FolderSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FolderSpec
{
    /**
     * Folder ID
     * @var string
     */
    private $_l;

    /**
     * Constructor method for FolderSpec
     * @param string $l
     * @return self
     */
    public function __construct($l = null)
    {
        $this->_l = trim($l);
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'folder')
    {
        $name = !empty($name) ? $name : 'folder';
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
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
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
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
