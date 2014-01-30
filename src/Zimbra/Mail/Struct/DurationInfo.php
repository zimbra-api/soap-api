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
 * DurationInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DurationInfo extends Base
{
    /**
     * Constructor method for DurationInfo
     * @param  bool   $neg Set if the duration is negative.
     * @param  int    $w Weeks component of the duration
     * @param  int    $d Days component of the duration.
     * @param  int    $h Hours component of the duration.
     * @param  int    $m Minutes component of the duration.
     * @param  int    $s Seconds component of the duration.
     * @param  string $related Specifies whether the alarm is related to the start of end. Valid values are : START|END
     * @param  int    $count Alarm repeat count
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
        parent::__construct();
        if(null !== $neg)
        {
            $this->property('neg', (bool) $neg);
        }
        if(null !== $w)
        {
            $this->property('w', (int) $w);
        }
        if(null !== $d)
        {
            $this->property('d', (int) $d);
        }
        if(null !== $h)
        {
            $this->property('h', (int) $h);
        }
        if(null !== $m)
        {
            $this->property('m', (int) $m);
        }
        if(null !== $s)
        {
            $this->property('s', (int) $s);
        }
        if(null !== $related)
        {
            $this->property('related', in_array(trim($related), array('START', 'END')) ? trim($related) : '');
        }
        if(null !== $count)
        {
            $this->property('count', (int) $count);
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
            return $this->property('neg');
        }
        return $this->property('neg', (bool) $neg);
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
            return $this->property('w');
        }
        return $this->property('w', (int) $w);
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
            return $this->property('d');
        }
        return $this->property('d', (int) $d);
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
            return $this->property('h');
        }
        return $this->property('h', (int) $h);
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
            return $this->property('m');
        }
        return $this->property('m', (int) $m);
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
            return $this->property('s');
        }
        return $this->property('s', (int) $s);
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
            return $this->property('related');
        }
        return $this->property('related', in_array(trim($related), array('START', 'END')) ? trim($related) : '');
        return $this;
    }

    /**
     * Gets or sets count
     *
     * @param  int $count
     * @return int|self
     */
    public function count($count = null)
    {
        if(null === $count)
        {
            return $this->property('count');
        }
        return $this->property('count', (int) $count);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rel')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $uid
     * @return SimpleXML
     */
    public function toXml($name = 'rel')
    {
        return parent::toXml($name);
    }
}
