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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * MimePartInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MimePartInfo extends Base
{
    /**
     * MIME Parts 
     * @var TypedSequence
     */
    private $_mp;

    /**
     * Constructor method for MimePartInfo
     * @param  array $mps MIME Parts 
     * @param  AttachmentsInfo $attach Attachments
     * @param  string $ct Content type.
     * @param  string $content Content.
     * @param  string $ci Content ID.
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
        parent::__construct();
        $this->_mp = new TypedSequence('Zimbra\Mail\Struct\MimePartInfo', $mps);
        if($attach instanceof AttachmentsInfo)
        {
            $this->child('attach', $attach);
        }
        if(null !== $ct)
        {
            $this->property('ct', trim($ct));
        }
        if(null !== $content)
        {
            $this->property('content', trim($content));
        }
        if(null !== $ci)
        {
            $this->property('ci', trim($ci));
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->mp()->count())
            {
                $sender->child('mp', $sender->mp()->all());
            }
        });
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
            return $this->child('attach');
        }
        return $this->child('attach', $attach);
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
     * Gets or sets ci
     *
     * @param  string $ci
     * @return string|self
     */
    public function ci($ci = null)
    {
        if(null === $ci)
        {
            return $this->property('ci');
        }
        return $this->property('ci', trim($ci));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mp')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mp')
    {
        return parent::toXml($name);
    }
}
