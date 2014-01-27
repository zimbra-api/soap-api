<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * AttachmentsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class AttachmentsInfo extends Base
{
    /**
     * Constructor method for AttachmentsInfo
     * @param  MimePartAttachSpec $mp MimePart Attach Spec
     * @param  MsgAttachSpec $m Msg Attach Spec
     * @param  ContactAttachSpec $cn Contact Attach Spec
     * @param  DocAttachSpec $doc Doc Attach Spec
     * @param  string $aid Attachment upload ID
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
        parent::__construct();
        if($mp instanceof MimePartAttachSpec)
        {
            $this->child('mp', $mp);
        }
        if($m instanceof MsgAttachSpec)
        {
            $this->child('m', $m);
        }
        if($cn instanceof ContactAttachSpec)
        {
            $this->child('cn', $cn);
        }
        if($doc instanceof DocAttachSpec)
        {
            $this->child('doc', $doc);
        }
        if(null !== $aid)
        {
            $this->property('aid', trim($aid));
        }
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
            return $this->child('mp');
        }
        return $this->child('mp', $mp);
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
            return $this->child('m');
        }
        return $this->child('m', $m);
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
            return $this->child('cn');
        }
        return $this->child('cn', $cn);
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
            return $this->child('doc');
        }
        return $this->child('doc', $doc);
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
            return $this->property('aid');
        }
        return $this->property('aid', trim($aid));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'attach')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attach')
    {
        return parent::toXml($name);
    }
}
