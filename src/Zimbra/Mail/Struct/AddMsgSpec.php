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
 * AddMsgSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class AddMsgSpec extends Base
{
    /**
     * Constructor method for AddMsgSpec
     * @param string $content The entire message's content. (Omit if you specify an "aid" attribute.)
     * @param string $f Flags - (u)nread, (f)lagged, has (a)ttachment, (r)eplied, (s)ent by me, for(w)arded, (d)raft, deleted (x), (n)otification sent
     * @param string $t Tags - Comma separated list of integers. DEPRECATED - use "tn" instead
     * @param string $tn Comma-separated list of tag names
     * @param string $l Folder pathname (starts with '/') or folder ID
     * @param bool   $noICal If set, then don't process iCal attachments. Default is unset.
     * @param string $d Time the message was originally received, in MILLISECONDS since the epoch
     * @param string $aid Uploaded MIME body ID - ID of message uploaded via FileUploadServlet
     * @return self
     */
    public function __construct(
        $content = null,
        $f = null,
        $t = null,
        $tn = null,
        $l = null,
        $noICal = null,
        $d = null,
        $aid = null
    )
    {
        parent::__construct();
        if(null !== $content)
        {
            $this->child('content', trim($content));
        }
        if(null !== $f)
        {
            $this->property('f', trim($f));
        }
        if(null !== $t)
        {
            $this->property('t', trim($t));
        }
        if(null !== $tn)
        {
            $this->property('tn', trim($tn));
        }
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
        if(null !== $noICal)
        {
            $this->property('noICal', (bool) $noICal);
        }
        if(null !== $d)
        {
            $this->property('d', trim($d));
        }
        if(null !== $aid)
        {
            $this->property('aid', trim($aid));
        }
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
            return $this->child('content');
        }
        return $this->child('content', trim($content));
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
     * Gets or sets t
     *
     * @param  string $t
     * @return string|self
     */
    public function t($t = null)
    {
        if(null === $t)
        {
            return $this->property('t');
        }
        return $this->property('t', trim($t));
    }

    /**
     * Gets or sets tn
     *
     * @param  string $tn
     * @return string|self
     */
    public function tn($tn = null)
    {
        if(null === $tn)
        {
            return $this->property('tn');
        }
        return $this->property('tn', trim($tn));
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
     * Gets or sets noICal
     *
     * @param  bool $noICal
     * @return bool|self
     */
    public function noICal($noICal = null)
    {
        if(null === $noICal)
        {
            return $this->property('noICal');
        }
        return $this->property('noICal', (bool) $noICal);
    }

    /**
     * Gets or sets d
     *
     * @param  string $d
     * @return string|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->property('d');
        }
        return $this->property('d', trim($d));
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
    public function toArray($name = 'm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        return parent::toXml($name);
    }
}
