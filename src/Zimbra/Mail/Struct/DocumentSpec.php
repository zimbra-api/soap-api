<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copypart and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;
use Zimbra\Struct\Id;

/**
 * DocumentSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocumentSpec extends Base
{
    /**
     * Constructor method for DocumentSpec
     * @param Id $upload Upload specification
     * @param MessagePartSpec $m MessageMessage part specification
     * @param IdVersion $doc Information on document version to restore to
     * @param string $name File name
     * @param string $ct Content Type
     * @param string $desc Description
     * @param string $l Folder ID
     * @param string $id Item ID
     * @param int    $ver Last known version
     * @param string $content Inlined document content string
     * @param bool   $descEnabled Desc enabled flag
     * @param string $f  - Any of the flags specified in soap.txt, with the addition of "t", which specifies that the document is a note.
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
        parent::__construct();
        if($upload instanceof Id)
        {
            $this->child('upload', $upload);
        }
        if($m instanceof MessagePartSpec)
        {
            $this->child('m', $m);
        }
        if($doc instanceof IdVersion)
        {
            $this->child('doc', $doc);
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $ct)
        {
            $this->property('ct', trim($ct));
        }
        if(null !== $desc)
        {
            $this->property('desc', trim($desc));
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $ver)
        {
            $this->property('ver', (int) $ver);
        }
        if(null !== $content)
        {
            $this->property('content', trim($content));
        }
        if(null !== $descEnabled)
        {
            $this->property('descEnabled', (bool) $descEnabled);
        }
        if(null !== $f)
        {
            $this->property('f', trim($f));
        }
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
            return $this->child('upload');
        }
        return $this->child('upload', $upload);
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
            return $this->child('m');
        }
        return $this->child('m', $m);
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
            return $this->child('doc');
        }
        return $this->child('doc', $doc);
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
            return $this->property('name');
        }
        return $this->property('name', trim($name));
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
            return $this->property('ct');
        }
        return $this->property('ct', trim($ct));
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
            return $this->property('desc');
        }
        return $this->property('desc', trim($desc));
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
            return $this->property('l');
        }
        return $this->property('l', trim($l));
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
            return $this->property('id');
        }
        return $this->property('id', trim($id));
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
            return $this->property('ver');
        }
        return $this->property('ver', (int) $ver);
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
            return $this->property('content');
        }
        return $this->property('content', trim($content));
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
            return $this->property('descEnabled');
        }
        return $this->property('descEnabled', (bool) $descEnabled);
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
            return $this->property('f');
        }
        return $this->property('f', trim($f));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'doc')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'doc')
    {
        return parent::toXml($name);
    }
}
