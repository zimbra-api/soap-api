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
 * MsgSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MsgSpec
{
    /**
     * Message ID. Can contain a subpart identifier (e.g. "775-778") to return a message stored as a subpart of some other mail-item, specifically for Messages stored as part of Appointments
     * @var string
     */
    private $_id;

    /**
     * Supply a "part" and the retrieved data will be on the specified message/rfc822 subpart.
     * If the part does not exist or is not a message/rfc822 part, mail.NO_SUCH_PART MailServiceException will be thrown
     * @var string
     */
    private $_part;

    /**
     * Set to return the raw message content rather than a parsed mime structure;
     * (default is unset. if message is too big or not ASCII, a content servlet URL is returned)
     * @var bool
     */
    private $_raw;

    /**
     * Set to mark the message as read, unset to leave the read status unchanged.
     * By default, the read status is left unchanged.
     * @var bool
     */
    private $_read;

    /**
     * Use {max-inlined-length} to limit the length of the text inlined into body <content> when raw is set.
     * (default is unset, meaning no limit.)
     * @var int
     */
    private $_max;

    /**
     * Set to return defanged HTML content by default. (default is unset.)
     * @var bool
     */
    private $_html;

    /**
     * Set to "neuter" <IMG> tags returned in HTML content;
     * this involves switching the "src" attribute to "dfsrc" so that images don't display by default (default is set.)
     * @var bool
     */
    private $_neuter;

    /**
    * Recurrence ID in format YYYYMMDD[ThhmmssZ].
    * Used only when making GetMsg call to open an instance of a recurring appointment.
    * The value specified is the date/time data of the RECURRENCE-ID of the instance being requested.
     * @var string
     */
    private $_ridZ;

    /**
     * Set to return group info (isGroup and exp flags) on <e> elements in the response (default is unset.)
     * @var bool
     */
    private $_needExp;

    /**
     * Requested headers.
     * if <header>s are requested, any matching headers are inlined into the response (not available when raw is set)
     * @var TypedSequence<AttributeName>
     */
    private $_header;

    /**
     * Constructor method for MsgSpec
     * @param string $id
     * @param array  $header
     * @param string $part
     * @param bool   $raw
     * @param bool   $read
     * @param int    $max
     * @param bool   $html
     * @param bool   $neuter
     * @param string $ridZ
     * @param bool   $needExp
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
        $this->_id = trim($id);
        $this->_header = new TypedSequence('Zimbra\Soap\Struct\AttributeName', $header);
        $this->_part = trim($part);
        if(null !== $raw)
        {
            $this->_raw = (bool) $raw;
        }
        if(null !== $read)
        {
            $this->_read = (bool) $read;
        }
        if(null !== $max)
        {
            $this->_max = (int) $max;
        }
        if(null !== $html)
        {
            $this->_html = (bool) $html;
        }
        if(null !== $neuter)
        {
            $this->_neuter = (bool) $neuter;
        }
        $this->_ridZ = trim($ridZ);
        if(null !== $needExp)
        {
            $this->_needExp = (bool) $needExp;
        }
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
     * Gets or sets part
     *
     * @param  string $part
     * @return string|self
     */
    public function part($part = null)
    {
        if(null === $part)
        {
            return $this->_part;
        }
        $this->_part = trim($part);
        return $this;
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
            return $this->_raw;
        }
        $this->_raw = (bool) $raw;
        return $this;
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
            return $this->_read;
        }
        $this->_read = (bool) $read;
        return $this;
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
            return $this->_max;
        }
        $this->_max = (int) $max;
        return $this;
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
            return $this->_html;
        }
        $this->_html = (bool) $html;
        return $this;
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
            return $this->_neuter;
        }
        $this->_neuter = (bool) $neuter;
        return $this;
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
            return $this->_ridZ;
        }
        $this->_ridZ = trim($ridZ);
        return $this;
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
            return $this->_needExp;
        }
        $this->_needExp = (bool) $needExp;
        return $this;
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $arr = array(
        	'id' => $this->_id,
    	);
        if(!empty($this->_part))
        {
            $arr['part'] = $this->_part;
        }
        if(is_bool($this->_raw))
        {
            $arr['raw'] = $this->_raw ? 1 : 0;
        }
        if(is_bool($this->_read))
        {
            $arr['read'] = $this->_read ? 1 : 0;
        }
        if(is_int($this->_max))
        {
            $arr['max'] = $this->_max;
        }
        if(is_bool($this->_html))
        {
            $arr['html'] = $this->_html ? 1 : 0;
        }
        if(is_bool($this->_neuter))
        {
            $arr['neuter'] = $this->_neuter ? 1 : 0;
        }
        if(!empty($this->_ridZ))
        {
            $arr['ridZ'] = $this->_ridZ;
        }
        if(is_bool($this->_needExp))
        {
            $arr['needExp'] = $this->_needExp ? 1 : 0;
        }
        if(count($this->_header))
        {
            $arr['header'] = array();
            foreach ($this->_header as $header)
            {
                $headerArr = $header->toArray('header');
                $arr['header'][] = $headerArr['header'];
            }
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id);
        if(!empty($this->_part))
        {
        	$xml->addAttribute('part', $this->_part);
        }
        if(is_bool($this->_raw))
        {
            $xml->addAttribute('raw', $this->_raw ? 1 : 0);
        }
        if(is_bool($this->_read))
        {
            $xml->addAttribute('read', $this->_read ? 1 : 0);
        }
        if(is_int($this->_max))
        {
            $xml->addAttribute('max', $this->_max);
        }
        if(is_bool($this->_html))
        {
            $xml->addAttribute('html', $this->_html ? 1 : 0);
        }
        if(is_bool($this->_neuter))
        {
            $xml->addAttribute('neuter', $this->_neuter ? 1 : 0);
        }
        if(!empty($this->_ridZ))
        {
        	$xml->addAttribute('ridZ', $this->_ridZ);
        }
        if(is_bool($this->_needExp))
        {
            $xml->addAttribute('needExp', $this->_needExp ? 1 : 0);
        }
        foreach ($this->_header as $header)
        {
            $xml->append($header->toXml('header'));
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
