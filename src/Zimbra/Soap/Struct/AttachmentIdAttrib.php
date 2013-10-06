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
 * AttachmentIdAttrib class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AttachmentIdAttrib
{
    /**
     * Attachment ID
     * @var string
     */
    private $_aid;

    /**
     * Constructor method for AttachmentIdAttrib
     * @param  string $aid
     * @return self
     */
    public function __construct($aid = null)
    {
        $this->_aid = trim($aid);
    }

    /**
     * Gets or sets aid
     *
     * @param  string $aid
     * @return string|self
     */
    public function aid($aid = null)
    {
        if(null === $aid)
        {
            return $this->_aid;
        }
        $this->_aid = trim($aid);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'content')
    {
        $name = !empty($name) ? $name : 'content';
        $arr = array();
        if(!empty($this->_aid))
        {
            $arr['aid'] = $this->_aid;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'content')
    {
        $name = !empty($name) ? $name : 'content';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_aid))
        {
            $xml->addAttribute('aid', $this->_aid);
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
