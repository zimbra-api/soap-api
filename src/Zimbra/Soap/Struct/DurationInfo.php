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
 * DurationInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DurationInfo
{
    /**
     * Set if the duration is negative.
     * @var bool
     */
    private $_neg;

    /**
     * Weeks component of the duration.
     * Special note: if WEEKS are specified, NO OTHER OFFSET MAY BE SPECIFIED (weeks must be alone, per RFC2445)
     * @var int
     */
    private $_w;

    /**
     * Days component of the duration.
     * @var int
     */
    private $_d;

    /**
     * Hours component of the duration.
     * @var int
     */
    private $_h;

    /**
     * Minutes component of the duration.
     * @var int
     */
    private $_m;

    /**
     * Seconds component of the duration.
     * @var int
     */
    private $_s;

    /**
     * Specifies whether the alarm is related to the start of end.
     * Valid values are : START|END
     * @var string
     */
    private $_related;

    /**
     * Alarm repeat count
     * @var int
     */
    private $_count;

    /**
     * Constructor method for DurationInfo
     * @param  bool   $neg
     * @param  int    $w
     * @param  int    $d
     * @param  int    $h
     * @param  int    $m
     * @param  int    $s
     * @param  string $related
     * @param  int    $count
     * @return self
     */
    public function __construct(
        $neg = null,
        $w = null,
        $d = null,
        $h = null,
        $m = null,
        $s = null,
        $related = null,
        $count = null
    )
    {
        if(null !== $neg)
        {
            $this->_neg = (bool) $neg;
        }
        if(null !== $w)
        {
            $this->_w = (int) $w;
        }
        if(null !== $d)
        {
            $this->_d = (int) $d;
        }
        if(null !== $h)
        {
            $this->_h = (int) $h;
        }
        if(null !== $m)
        {
            $this->_m = (int) $m;
        }
        if(null !== $s)
        {
            $this->_s = (int) $s;
        }
        $this->_related = in_array(trim($related), array('START', 'END')) ? trim($related) : '';
        if(null !== $s)
        {
            $this->_count = (int) $count;
        }
    }

    /**
     * Gets or sets neg
     *
     * @param  bool $neg
     * @return bool|self
     */
    public function neg($neg = null)
    {
        if(null === $neg)
        {
            return $this->_neg;
        }
        $this->_neg = (bool) $neg;
        return $this;
    }

    /**
     * Gets or sets w
     *
     * @param  int $w
     * @return int|self
     */
    public function w($w = null)
    {
        if(null === $w)
        {
            return $this->_w;
        }
        $this->_w = (int) $w;
        return $this;
    }

    /**
     * Gets or sets d
     *
     * @param  int $d
     * @return int|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->_d;
        }
        $this->_d = (int) $d;
        return $this;
    }

    /**
     * Gets or sets h
     *
     * @param  int $h
     * @return int|self
     */
    public function h($h = null)
    {
        if(null === $h)
        {
            return $this->_h;
        }
        $this->_h = (int) $h;
        return $this;
    }

    /**
     * Gets or sets m
     *
     * @param  int $m
     * @return int|self
     */
    public function m($m = null)
    {
        if(null === $m)
        {
            return $this->_m;
        }
        $this->_m = (int) $m;
        return $this;
    }

    /**
     * Gets or sets s
     *
     * @param  int $s
     * @return int|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->_s;
        }
        $this->_s = (int) $s;
        return $this;
    }

    /**
     * Gets or sets related
     *
     * @param  int $related
     * @return int|self
     */
    public function related($related = null)
    {
        if(null === $related)
        {
            return $this->_related;
        }
        $this->_related = in_array(trim($related), array('START', 'END')) ? trim($related) : '';
        return $this;
    }

    /**
     * Gets or sets w
     *
     * @param  int $w
     * @return int|self
     */
    public function count($count = null)
    {
        if(null === $count)
        {
            return $this->_count;
        }
        $this->_count = (int) $count;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rel')
    {
        $name = !empty($name) ? $name : 'rel';
        $arr = array();
        if(is_bool($this->_neg))
        {
            $arr['neg'] = $this->_neg ? 1 : 0;
        }
        if(is_int($this->_w))
        {
            $arr['w'] = $this->_w;
        }
        if(is_int($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(is_int($this->_h))
        {
            $arr['h'] = $this->_h;
        }
        if(is_int($this->_m))
        {
            $arr['m'] = $this->_m;
        }
        if(is_int($this->_s))
        {
            $arr['s'] = $this->_s;
        }
        if(!empty($this->_related))
        {
            $arr['related'] = $this->_related;
        }
        if(is_int($this->_count))
        {
            $arr['count'] = $this->_count;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $uid
     * @return SimpleXML
     */
    public function toXml($name = 'rel')
    {
        $name = !empty($name) ? $name : 'rel';
        $xml = new SimpleXML('<'.$name.' />');
        if(is_bool($this->_neg))
        {
            $xml->addAttribute('neg', $this->_neg ? 1 : 0);
        }
        if(is_int($this->_w))
        {
            $xml->addAttribute('w', $this->_w);
        }
        if(is_int($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(is_int($this->_h))
        {
            $xml->addAttribute('h', $this->_h);
        }
        if(is_int($this->_m))
        {
            $xml->addAttribute('m', $this->_m);
        }
        if(is_int($this->_s))
        {
            $xml->addAttribute('s', $this->_s);
        }
        if(!empty($this->_related))
        {
            $xml->addAttribute('related', $this->_related);
        }
        if(is_int($this->_count))
        {
            $xml->addAttribute('count', $this->_count);
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
