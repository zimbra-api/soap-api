<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copypart and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * DocumentSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copypart © 2013 by Nguyen Van Nguyen.
 */
class DocumentSpec
{
    /**
     * Upload specification
     * @var Id
     */
    private $_upload;

    /**
     * MessageMessage part specification
     * @var MessagePartSpec
     */
    private $_m;

    /**
     * Information on document version to restore to
     * @var IdVersion
     */
    private $_doc;

    /**
     * File name
     * @var string
     */
    private $_name;

    /**
     * Content Type
     * @var string
     */
    private $_ct;

    /**
     * Description
     * @var string
     */
    private $_desc;

    /**
     * Folder ID
     * @var string
     */
    private $_l;

    /**
     * Item ID
     * @var string
     */
    private $_id;

    /**
     * Last known version
     * @var int
     */
    private $_ver;

    /**
     * Inlined document content string
     * @var string
     */
    private $_content;

    /**
     * Desc enabled flag
     * @var bool
     */
    private $_descEnabled;

    /**
     * Flags - Any of the flags specified in soap.txt, with the addition of "t", which specifies that the document is a note.
     * @var string
     */
    private $_f;

    /**
     * Constructor method for DocumentSpec
     * @param Id $upload
     * @param MessagePartSpec $m
     * @param IdVersion $doc
     * @param string $name
     * @param string $ct
     * @param string $desc
     * @param string $l
     * @param string $id
     * @param int    $ver
     * @param string $content
     * @param bool   $descEnabled
     * @param string $f
     * @return self
     */
    public function __construct(
        Id $upload = null,
        MessagePartSpec $m = null,
        IdVersion $doc = null,
        $name = null,
        $ct = null,
        $desc = null,
        $l = null,
        $id = null,
        $ver = null,
        $content = null,
        $descEnabled = null,
        $f = null
    )
    {
        if($upload instanceof Id)
        {
            $this->_upload = $upload;
        }
        if($m instanceof MessagePartSpec)
        {
            $this->_m = $m;
        }
        if($doc instanceof IdVersion)
        {
            $this->_doc = $doc;
        }
        $this->_name = trim($name);
        $this->_ct = trim($ct);
        $this->_desc = trim($desc);
        $this->_l = trim($l);
        $this->_id = trim($id);
        if(null !== $ver)
        {
            $this->_ver = (int) $ver;
        }
        $this->_content = trim($content);
        if(null !== $descEnabled)
        {
            $this->_descEnabled = (bool) $descEnabled;
        }
        $this->_f = trim($f);
    }

    /**
     * Gets or sets upload
     *
     * @param  Id $upload
     * @return Id|self
     */
    public function upload(Id $upload = null)
    {
        if(null === $upload)
        {
            return $this->_upload;
        }
        $this->_upload = $upload;
        return $this;
    }

    /**
     * Gets or sets m
     *
     * @param  MessagePartSpec $m
     * @return MessagePartSpec|self
     */
    public function m(MessagePartSpec $m = null)
    {
        if(null === $m)
        {
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
    }

    /**
     * Gets or sets doc
     *
     * @param  IdVersion $doc
     * @return IdVersion|self
     */
    public function doc(IdVersion $doc = null)
    {
        if(null === $doc)
        {
            return $this->_doc;
        }
        $this->_doc = $doc;
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
     * Gets or sets desc
     *
     * @param  string $desc
     * @return string|self
     */
    public function desc($desc = null)
    {
        if(null === $desc)
        {
            return $this->_desc;
        }
        $this->_desc = trim($desc);
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
     * Gets or sets descEnabled
     *
     * @param  bool $descEnabled
     * @return bool|self
     */
    public function descEnabled($descEnabled = null)
    {
        if(null === $descEnabled)
        {
            return $this->_descEnabled;
        }
        $this->_descEnabled = (bool) $descEnabled;
        return $this;
    }

    /**
     * Gets or sets f
     *
     * @param  string $f
     * @return string|self
     */
    public function f($f = null)
    {
        if(null === $f)
        {
            return $this->_f;
        }
        $this->_f = trim($f);
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

        if(!empty($this->_name))
        {
            $arr['name'] = $this->_name;
        }
        if(!empty($this->_ct))
        {
            $arr['ct'] = $this->_ct;
        }
        if(!empty($this->_desc))
        {
            $arr['desc'] = $this->_desc;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(!empty($this->_id))
        {
            $arr['id'] = $this->_id;
        }
        if(is_int($this->_ver))
        {
            $arr['ver'] = $this->_ver;
        }
        if(!empty($this->_content))
        {
            $arr['content'] = $this->_content;
        }
        if(is_bool($this->_descEnabled))
        {
            $arr['descEnabled'] = $this->_descEnabled ? 1 : 0;
        }
        if(!empty($this->_f))
        {
            $arr['f'] = $this->_f;
        }
        if($this->_upload instanceof Id)
        {
            $arr += $this->_upload->toArray('upload');
        }
        if($this->_m instanceof MessagePartSpec)
        {
            $arr += $this->_m->toArray('m');
        }
        if($this->_doc instanceof IdVersion)
        {
            $arr += $this->_doc->toArray('doc');
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

        if(!empty($this->_name))
        {
            $xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_ct))
        {
            $xml->addAttribute('ct', $this->_ct);
        }
        if(!empty($this->_desc))
        {
            $xml->addAttribute('desc', $this->_desc);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        if(!empty($this->_id))
        {
            $xml->addAttribute('id', $this->_id);
        }
        if(is_int($this->_ver))
        {
            $xml->addAttribute('ver', $this->_ver);
        }
        if(!empty($this->_content))
        {
            $xml->addAttribute('content', $this->_content);
        }
        if(is_bool($this->_descEnabled))
        {
            $xml->addAttribute('descEnabled', $this->_descEnabled ? 1 : 0);
        }
        if(!empty($this->_f))
        {
            $xml->addAttribute('f', $this->_f);
        }
        if($this->_upload instanceof Id)
        {
            $xml->append($this->_upload->toXml('upload'));
        }
        if($this->_m instanceof MessagePartSpec)
        {
            $xml->append($this->_m->toXml('m'));
        }
        if($this->_doc instanceof IdVersion)
        {
            $xml->append($this->_doc->toXml('doc'));
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
