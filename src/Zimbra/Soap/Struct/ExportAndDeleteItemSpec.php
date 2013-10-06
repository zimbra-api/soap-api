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
 * ExportAndDeleteItemSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExportAndDeleteItemSpec
{
    /**
     * ID
     * @var int
     */
    private $_id;

    /**
     * Version
     * @var int
     */
    private $_version;

    /**
     * Constructor method for ExportAndDeleteItemSpec
     * @param  int $id
     * @param  int $version
     * @return self
     */
    public function __construct($id, $version)
    {
        $this->_id = (int) $id;
        $this->_version = (int) $version;
    }

    /**
     * Gets or sets id
     *
     * @param  int $id
     * @return int|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = (int) $id;
        return $this;
    }

    /**
     * Gets or sets version
     *
     * @param  int $version
     * @return int|self
     */
    public function version($version = null)
    {
        if(null === $version)
        {
            return $this->_version;
        }
        $this->_version = (int) $version;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'item')
    {
        $name = !empty($name) ? $name : 'item';
        $arr = array(
            'id' => $this->_id,
            'version' => $this->_version,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'item')
    {
        $name = !empty($name) ? $name : 'item';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id)
            ->addAttribute('version', $this->_version);
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
