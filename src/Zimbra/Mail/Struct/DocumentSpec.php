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
     * @param string $name File name
     * @param string $ct Content Type
     * @param string $desc Description
     * @param string $l Folder ID
     * @param string $id Item ID
     * @param int    $ver Last known version
     * @param string $content Inlined document content string
     * @param bool   $descEnabled Desc enabled flag
     * @param string $f  - Any of the flags specified in soap.txt, with the addition of "t", which specifies that the document is a note.
     * @param Id $upload Upload specification
     * @param MessagePartSpec $m MessageMessage part specification
     * @param IdVersion $doc Information on document version to restore to
     * @return self
     */
    public function __construct(
        $name = null,
        $ct = null,
        $desc = null,
        $l = null,
        $id = null,
        $ver = null,
        $content = null,
        $descEnabled = null,
        $f = null,
        Id $upload = null,
        MessagePartSpec $m = null,
        IdVersion $doc = null
    )
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $ct)
        {
            $this->setProperty('ct', trim($ct));
        }
        if(null !== $desc)
        {
            $this->setProperty('desc', trim($desc));
        }
        if(null !== $l)
        {
            $this->setProperty('l', trim($l));
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $ver)
        {
            $this->setProperty('ver', (int) $ver);
        }
        if(null !== $content)
        {
            $this->setProperty('content', trim($content));
        }
        if(null !== $descEnabled)
        {
            $this->setProperty('descEnabled', (bool) $descEnabled);
        }
        if(null !== $f)
        {
            $this->setProperty('f', trim($f));
        }
        if($upload instanceof Id)
        {
            $this->setChild('upload', $upload);
        }
        if($m instanceof MessagePartSpec)
        {
            $this->setChild('m', $m);
        }
        if($doc instanceof IdVersion)
        {
            $this->setChild('doc', $doc);
        }
    }

    /**
     * Gets upload
     *
     * @return Id
     */
    public function getUpload()
    {
        return $this->getChild('upload');
    }

    /**
     * Sets upload
     *
     * @param  Id $upload
     * @return self
     */
    public function setUpload(Id $upload)
    {
        return $this->setChild('upload', $upload);
    }

    /**
     * Gets message part
     *
     * @return MessagePartSpec
     */
    public function getMessagePart()
    {
        return $this->getChild('m');
    }

    /**
     * Sets message part
     *
     * @param  MessagePartSpec $m
     * @return self
     */
    public function setMessagePart(MessagePartSpec $m)
    {
        return $this->setChild('m', $m);
    }

    /**
     * Gets document version
     *
     * @return IdVersion
     */
    public function getDocRevision()
    {
        return $this->getChild('doc');
    }

    /**
     * Sets document version
     *
     * @param  IdVersion $doc
     * @return self
     */
    public function setDocRevision(IdVersion $doc)
    {
        return $this->setChild('doc', $doc);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->getProperty('ct');
    }

    /**
     * Sets content type
     *
     * @param  string $ct
     * @return self
     */
    public function setContentType($ct)
    {
        return $this->setProperty('ct', trim($ct));
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getProperty('desc');
    }

    /**
     * Sets description
     *
     * @param  string $desc
     * @return self
     */
    public function setDescription($desc)
    {
        return $this->setProperty('desc', trim($desc));
    }

    /**
     * Gets folder ID
     *
     * @return string
     */
    public function getFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder ID
     *
     * @param  string $l
     * @return self
     */
    public function setFolderId($l)
    {
        return $this->setProperty('l', trim($l));
    }

    /**
     * Gets item id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets item id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets ver
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->getProperty('ver');
    }

    /**
     * Sets ver
     *
     * @param  int $ver
     * @return self
     */
    public function setVersion($ver)
    {
        return $this->setProperty('ver', (int) $ver);
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getProperty('content');
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent($content)
    {
        return $this->setProperty('content', trim($content));
    }

    /**
     * Gets desc enabled flag
     *
     * @return bool
     */
    public function getDescEnabled()
    {
        return $this->getProperty('descEnabled');
    }

    /**
     * Sets desc enabled flag
     *
     * @param  bool $descEnabled
     * @return self
     */
    public function setDescEnabled($descEnabled)
    {
        return $this->setProperty('descEnabled', (bool) $descEnabled);
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags()
    {
        return $this->getProperty('f');
    }

    /**
     * Sets flags
     *
     * @param  string $f
     * @return self
     */
    public function setFlags($f)
    {
        return $this->setProperty('f', trim($f));
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
