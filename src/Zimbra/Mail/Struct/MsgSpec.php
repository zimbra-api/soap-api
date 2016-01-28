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
use Zimbra\Struct\AttributeName;

/**
 * MsgSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MsgSpec extends Base
{
    /**
     * Requested headers.
     * if <header>s are requested, any matching headers are inlined into the response (not available when raw is set)
     * @var TypedSequence<AttributeName>
     */
    private $_headers;

    /**
     * Constructor method for MsgSpec
     * @param string $id Message ID. Can contain a subpart identifier (e.g. "775-778") to return a message stored as a subpart of some other mail-item, specifically for Messages stored as part of Appointments
     * @param string $part Supply a "part" and the retrieved data will be on the specified message/rfc822 subpart.
     * @param bool   $raw Set to return the raw message content rather than a parsed mime structure;
     * @param bool   $read Set to mark the message as read, unset to leave the read status unchanged.
     * @param int    $max Use {max-inlined-length} to limit the length of the text inlined into body <content> when raw is set.
     * @param bool   $html Set to return defanged HTML content by default. (default is unset.)
     * @param bool   $neuter Set to "neuter" <IMG> maxs returned in HTML content;
     * @param string $ridZ Recurrence ID in format YYYYMMDD[ThhmmssZ].
     * @param bool   $needExp Set to return group info (isGroup and exp flags) on <e> elements in the response (default is unset.)
     * @param array  $headers Requested headers.
     * @return self
     */
    public function __construct(
        $id,
        $part = null,
        $raw = null,
        $read = null,
        $max = null,
        $html = null,
        $neuter = null,
        $ridZ = null,
        $needExp = null,
        array $headers = []
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        if(null !== $part)
        {
            $this->setProperty('part', trim($part));
        }
        if(null !== $raw)
        {
            $this->setProperty('raw', (bool) $raw);
        }
        if(null !== $read)
        {
            $this->setProperty('read', (bool) $read);
        }
        if(null !== $max)
        {
            $this->setProperty('max', (int) $max);
        }
        if(null !== $html)
        {
            $this->setProperty('html', (bool) $html);
        }
        if(null !== $neuter)
        {
            $this->setProperty('neuter', (bool) $neuter);
        }
        if(null !== $ridZ)
        {
            $this->setProperty('ridZ', trim($ridZ));
        }
        if(null !== $needExp)
        {
            $this->setProperty('needExp', (bool) $needExp);
        }

        $this->setHeaders($headers);
        $this->on('before', function(Base $sender)
        {
            if($sender->getHeaders()->count())
            {
                $sender->setChild('header', $sender->getHeaders()->all());
            }
        });
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Add header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header)
    {
        $this->_headers->add($header);
        return $this;
    }

    /**
     * Sets header sequence
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers)
    {
        $this->_headers = new TypedSequence('Zimbra\Struct\AttributeName', $headers);
        return $this;
    }

    /**
     * Gets header sequence
     *
     * @return Sequence
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * Gets part
     *
     * @return string
     */
    public function getPart()
    {
        return $this->getProperty('part');
    }

    /**
     * Sets part
     *
     * @param  string $part
     * @return self
     */
    public function setPart($part)
    {
        return $this->setProperty('part', trim($part));
    }

    /**
     * Gets raw
     *
     * @return bool
     */
    public function getRaw()
    {
        return $this->getProperty('raw');
    }

    /**
     * Sets raw
     *
     * @param  bool $raw
     * @return self
     */
    public function setRaw($raw)
    {
        return $this->setProperty('raw', (bool) $raw);
    }

    /**
     * Gets read
     *
     * @return bool
     */
    public function getRead()
    {
        return $this->getProperty('read');
    }

    /**
     * Sets read
     *
     * @param  bool $read
     * @return self
     */
    public function setRead($read)
    {
        return $this->setProperty('read', (bool) $read);
    }

    /**
     * Gets max inlined length
     *
     * @return int
     */
    public function getMaxInlinedLength()
    {
        return $this->getProperty('max');
    }

    /**
     * Sets max inlined length
     *
     * @param  int $max
     * @return self
     */
    public function setMaxInlinedLength($max)
    {
        return $this->setProperty('max', (int) $max);
    }

    /**
     * Gets html
     *
     * @return bool
     */
    public function getWantHtml()
    {
        return $this->getProperty('html');
    }

    /**
     * Sets html
     *
     * @param  bool $html
     * @return self
     */
    public function setWantHtml($html)
    {
        return $this->setProperty('html', (bool) $html);
    }

    /**
     * Gets neuter
     *
     * @return bool
     */
    public function getNeuter()
    {
        return $this->getProperty('neuter');
    }

    /**
     * Sets neuter
     *
     * @param  bool $neuter
     * @return self
     */
    public function setNeuter($neuter)
    {
        return $this->setProperty('neuter', (bool) $neuter);
    }

    /**
     * Gets recurrence ID
     *
     * @return string
     */
    public function getRecurIdZ()
    {
        return $this->getProperty('ridZ');
    }

    /**
     * Sets recurrence ID
     *
     * @param  string $ridZ
     * @return self
     */
    public function setRecurIdZ($ridZ)
    {
        return $this->setProperty('ridZ', trim($ridZ));
    }

    /**
     * Gets need can expand
     *
     * @return bool
     */
    public function getNeedCanExpand()
    {
        return $this->getProperty('needExp');
    }

    /**
     * Sets need can expand
     *
     * @param  bool $needExp
     * @return self
     */
    public function setNeedCanExpand($needExp)
    {
        return $this->setProperty('needExp', (bool) $needExp);
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
