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
 * AttachmentsInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AttachmentsInfo
{
    /**
     * MimePart Attach Spec
     * @var MimePartAttachSpec
     */
    private $_mp;

    /**
     * Msg Attach Spec
     * @var MsgAttachSpec
     */
    private $_m;

    /**
     * Contact Attach Spec
     * @var ContactAttachSpec
     */
    private $_cn;

    /**
     * Doc Attach Spec
     * @var DocAttachSpec
     */
    private $_doc;

    /**
     * Attachment upload ID
     * @var string
     */
    private $_aid;

    /**
     * Constructor method for AttachmentsInfo
     * @param  MimePartAttachSpec $mp
     * @param  MsgAttachSpec $m
     * @param  ContactAttachSpec $cn
     * @param  DocAttachSpec $doc
     * @param  string $aid
     * @return self
     */
    public function __construct(
        MimePartAttachSpec $mp = null,
        MsgAttachSpec $m = null,
        ContactAttachSpec $cn = null,
        DocAttachSpec $doc = null,
        $aid = null
    )
    {
        if($mp instanceof MimePartAttachSpec)
        {
            $this->_mp = $mp;
        }
        if($m instanceof MsgAttachSpec)
        {
            $this->_m = $m;
        }
        if($cn instanceof ContactAttachSpec)
        {
            $this->_cn = $cn;
        }
        if($doc instanceof DocAttachSpec)
        {
            $this->_doc = $doc;
        }
        $this->_aid = trim($aid);
    }

    /**
     * Gets or sets mp
     *
     * @param  MimePartAttachSpec $mp
     * @return MimePartAttachSpec|self
     */
    public function mp(MimePartAttachSpec $mp = null)
    {
        if(null === $mp)
        {
            return $this->_mp;
        }
        $this->_mp = $mp;
        return $this;
    }

    /**
     * Gets or sets m
     *
     * @param  MsgAttachSpec $m
     * @return MsgAttachSpec|m
     */
    public function m(MsgAttachSpec $m = null)
    {
        if(null === $m)
        {
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
    }

    /**
     * Gets or sets cn
     *
     * @param  ContactAttachSpec $cn
     * @return ContactAttachSpec|self
     */
    public function cn(ContactAttachSpec $cn = null)
    {
        if(null === $cn)
        {
            return $this->_cn;
        }
        $this->_cn = $cn;
        return $this;
    }

    /**
     * Gets or sets doc
     *
     * @param  DocAttachSpec $doc
     * @return DocAttachSpec|self
     */
    public function doc(DocAttachSpec $doc = null)
    {
        if(null === $doc)
        {
            return $this->_doc;
        }
        $this->_doc = $doc;
        return $this;
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
    public function toArray($name = 'attach')
    {
        $name = !empty($name) ? $name : 'attach';
        $arr = array();
        if(!empty($this->_aid))
        {
            $arr['aid'] = $this->_aid;
        }
        if($this->_mp instanceof MimePartAttachSpec)
        {
            $arr += $this->_mp->toArray('mp');
        }
        if($this->_m instanceof MsgAttachSpec)
        {
            $arr += $this->_m->toArray('m');
        }
        if($this->_cn instanceof ContactAttachSpec)
        {
            $arr += $this->_cn->toArray('cn');
        }
        if($this->_doc instanceof DocAttachSpec)
        {
            $arr += $this->_doc->toArray('doc');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attach')
    {
        $name = !empty($name) ? $name : 'attach';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_aid))
        {
            $xml->addAttribute('aid', $this->_aid);
        }
        if($this->_mp instanceof MimePartAttachSpec)
        {
            $xml->append($this->_mp->toXml('mp'));
        }
        if($this->_m instanceof MsgAttachSpec)
        {
            $xml->append($this->_m->toXml('m'));
        }
        if($this->_cn instanceof ContactAttachSpec)
        {
            $xml->append($this->_cn->toXml('cn'));
        }
        if($this->_doc instanceof DocAttachSpec)
        {
            $xml->append($this->_doc->toXml('doc'));
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
