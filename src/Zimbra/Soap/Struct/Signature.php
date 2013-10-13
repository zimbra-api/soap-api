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
 * Signature class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Signature
{
    /**
     * ID for the signature
     * @var string
     */
    private $_id;

    /**
     * Name for the signature
     * @var string
     */
    private $_name;

    /**
     * Contact ID
     * @var string
     */
    private $_cid;

    /**
     * Content of the signature array
     * @var array 
     */
    private $_contents = array();

    /**
     * Constructor method for signature
     * @param string $name
     * @param string $id
     * @param string $cid
     * @param array  $contents
     * @return self
     */
    public function __construct(
        $name = null,
        $id = null,
        $cid = null,
        array $contents = array())
    {
        $this->_name = trim($name);
        $this->_id = trim($id);
        $this->_cid = trim($cid);
        $this->_contents = new TypedSequence('Zimbra\Soap\Struct\SignatureContent', $contents);
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
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets cid
     *
     * @param  string $cid
     * @return string|self
     */
    public function cid($cid = null)
    {
        if(null === $cid)
        {
            return $this->_cid;
        }
        $this->_cid = trim($cid);
        return $this;
    }

    /**
     * Add a signature content
     *
     * @param  SignatureContent $content
     * @return self
     */
    public function addContent(SignatureContent $content)
    {
        $this->_contents->add($content);
        return $this;
    }

    /**
     * Gets signature content sequence
     *
     * @return Sequence
     */
    public function contents()
    {
        return $this->_contents;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array();
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_cid))
        {
            $arr['cid'] = $this->_cid;
        }
        if(count($this->_contents))
        {
            $arr['content'] = array();
            foreach ($this->_contents as $content)
            {
                $contentArr = $content->toArray();
                $arr['content'][] = $contentArr['content'];
            }
        }
        return array('signature' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<signature />');
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_cid))
        {
            $xml->addChild('cid', $this->_cid);
        }
        foreach ($this->_contents as $content)
        {
            $xml->append($content->toXml());
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
