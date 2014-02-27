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
    private $_header;

    /**
     * Constructor method for MsgSpec
     * @param string $id Message ID. Can contain a subpart identifier (e.g. "775-778") to return a message stored as a subpart of some other mail-item, specifically for Messages stored as part of Appointments
     * @param array  $header Requested headers.
     * @param string $part Supply a "part" and the retrieved data will be on the specified message/rfc822 subpart.
     * @param bool   $raw Set to return the raw message content rather than a parsed mime structure;
     * @param bool   $read Set to mark the message as read, unset to leave the read status unchanged.
     * @param int    $max Use {max-inlined-length} to limit the length of the text inlined into body <content> when raw is set.
     * @param bool   $html Set to return defanged HTML content by default. (default is unset.)
     * @param bool   $neuter Set to "neuter" <IMG> maxs returned in HTML content;
     * @param string $ridZ Recurrence ID in format YYYYMMDD[ThhmmssZ].
     * @param bool   $needExp Set to return group info (isGroup and exp flags) on <e> elements in the response (default is unset.)
     * @return self
     */
    public function __construct(
        $id,
        array $header = array(),
        $part = null,
        $raw = null,
        $read = null,
        $max = null,
        $html = null,
        $neuter = null,
        $ridZ = null,
        $needExp = null
    )
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->_header = new TypedSequence('Zimbra\Struct\AttributeName', $header);
        if(null !== $part)
        {
            $this->property('part', trim($part));
        }
        if(null !== $raw)
        {
            $this->property('raw', (bool) $raw);
        }
        if(null !== $read)
        {
            $this->property('read', (bool) $read);
        }
        if(null !== $max)
        {
            $this->property('max', (int) $max);
        }
        if(null !== $html)
        {
            $this->property('html', (bool) $html);
        }
        if(null !== $neuter)
        {
            $this->property('neuter', (bool) $neuter);
        }
        if(null !== $ridZ)
        {
            $this->property('ridZ', trim($ridZ));
        }
        if(null !== $needExp)
        {
            $this->property('needExp', (bool) $needExp);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->header()->count())
            {
                $sender->child('header', $sender->header()->all());
            }
        });
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
     * Add header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header)
    {
        $this->_header->add($header);
        return $this;
    }

    /**
     * Gets header sequence
     *
     * @return Sequence
     */
    public function header()
    {
        return $this->_header;
    }

    /**
     * Gets or sets part
     *
     * @param  string $part
     * @return string|self
     */
    public function part($part = null)
    {
        if(null === $part)
        {
            return $this->property('part');
        }
        return $this->property('part', trim($part));
    }

    /**
     * Gets or sets raw
     *
     * @param  bool $raw
     * @return bool|self
     */
    public function raw($raw = null)
    {
        if(null === $raw)
        {
            return $this->property('raw');
        }
        return $this->property('raw', (bool) $raw);
    }

    /**
     * Gets or sets read
     *
     * @param  bool $read
     * @return bool|self
     */
    public function read($read = null)
    {
        if(null === $read)
        {
            return $this->property('read');
        }
        return $this->property('read', (bool) $read);
    }

    /**
     * Gets or sets max
     *
     * @param  int $max
     * @return int|self
     */
    public function max($max = null)
    {
        if(null === $max)
        {
            return $this->property('max');
        }
        return $this->property('max', (int) $max);
    }

    /**
     * Gets or sets html
     *
     * @param  bool $html
     * @return bool|self
     */
    public function html($html = null)
    {
        if(null === $html)
        {
            return $this->property('html');
        }
        return $this->property('html', (bool) $html);
    }

    /**
     * Gets or sets neuter
     *
     * @param  bool $neuter
     * @return bool|self
     */
    public function neuter($neuter = null)
    {
        if(null === $neuter)
        {
            return $this->property('neuter');
        }
        return $this->property('neuter', (bool) $neuter);
    }

    /**
     * Gets or sets ridZ
     *
     * @param  string $ridZ
     * @return string|self
     */
    public function ridZ($ridZ = null)
    {
        if(null === $ridZ)
        {
            return $this->property('ridZ');
        }
        return $this->property('ridZ', trim($ridZ));
    }

    /**
     * Gets or sets needExp
     *
     * @param  bool $needExp
     * @return bool|self
     */
    public function needExp($needExp = null)
    {
        if(null === $needExp)
        {
            return $this->property('needExp');
        }
        return $this->property('needExp', (bool) $needExp);
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
