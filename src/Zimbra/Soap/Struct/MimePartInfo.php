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
 * MimePartInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MimePartInfo extends AttachSpec
{
    /**
     * MIME Parts 
     * @var TypedSequence
     */
    private $_mp;

    /**
     * Attachments
     * @var string
     */
    private $_attach;

    /**
     * Content type.
     * @var string
     */
    private $_ct;

    /**
     * Content.
     * @var string
     */
    private $_content;

    /**
     * Content ID.
     * @var string
     */
    private $_ci;

    /**
     * Constructor method for MimePartInfo
     * @param  array $mps
     * @param  AttachmentsInfo $attach
     * @param  string $ct
     * @param  string $content
     * @param  string $ci
     * @return self
     */
    public function __construct(
        array $mps = array(),
        AttachmentsInfo $attach = null,
        $ct = null,
        $content = null,
        $ci = null
    )
    {
        $this->_mp = new TypedSequence('Zimbra\Soap\Struct\MimePartInfo', $mps);
        if($attach instanceof AttachmentsInfo)
        {
            $this->_attach = $attach;
        }
        $this->_ct = trim($ct);
        $this->_content = trim($content);
        $this->_ci = trim($ci);
    }

    /**
     * Add a mime part info
     *
     * @param  MimePartInfo $mp
     * @return self
     */
    public function addMp(MimePartInfo $mp)
    {
        $this->_mp->add($mp);
        return $this;
    }

    /**
     * Gets mime part sequence
     *
     * @return Sequence
     */
    public function mp()
    {
        return $this->_mp;
    }

    /**
     * Gets or sets attach
     *
     * @param  AttachmentsInfo $attach
     * @return AttachmentsInfo|self
     */
    public function attach(AttachmentsInfo $attach = null)
    {
        if(null === $attach)
        {
            return $this->_attach;
        }
        $this->_attach = $attach;
        return $this;
    }

    /**
     * Gets or sets ct
     *
     * @param  string $ct
     * @return string|self
     */
    public function ct($ct = null)
    {
        if(null === $ct)
        {
            return $this->_ct;
        }
        $this->_ct = trim($ct);
        return $this;
    }

    /**
     * Gets or sets content
     *
     * @param  string $content
     * @return string|self
     */
    public function content($content = null)
    {
        if(null === $content)
        {
            return $this->_content;
        }
        $this->_content = trim($content);
        return $this;
    }

    /**
     * Gets or sets ci
     *
     * @param  string $ci
     * @return string|self
     */
    public function ci($ci = null)
    {
        if(null === $ci)
        {
            return $this->_ci;
        }
        $this->_ci = trim($ci);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mp')
    {
        $name = !empty($name) ? $name : 'mp';
        $arr = array();
        if(!empty($this->_ct))
        {
            $arr['ct'] = $this->_ct;
        }
        if(!empty($this->_content))
        {
            $arr['content'] = $this->_content;
        }
        if(!empty($this->_ci))
        {
            $arr['ci'] = $this->_ci;
        }
        if(count($this->_mp))
        {
            $arr['mp'] = array();
            foreach ($this->_mp as $mp)
            {
                $attrMp = $mp->toArray('mp');
                $arr['mp'][] = $attrMp['mp'];
            }
        }
        if($this->_attach instanceof AttachmentsInfo)
        {
            $arr += $this->_attach->toArray('attach');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mp')
    {
        $name = !empty($name) ? $name : 'mp';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_ct))
        {
            $xml->addAttribute('ct', $this->_ct);
        }
        if(!empty($this->_content))
        {
            $xml->addAttribute('content', $this->_content);
        }
        if(!empty($this->_ci))
        {
            $xml->addAttribute('ci', $this->_ci);
        }
        if(count($this->_mp))
        {
            foreach ($this->_mp as $mp)
            {
                $xml->append($mp->toXml('mp'));
            }
        }
        if($this->_attach instanceof AttachmentsInfo)
        {
            $xml->append($this->_attach->toXml('attach'));
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
