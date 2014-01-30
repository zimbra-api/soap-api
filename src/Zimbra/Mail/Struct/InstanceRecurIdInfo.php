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
 * InstanceRecurIdInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class InstanceRecurIdInfo extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param string $range Range - THISANDFUTURE|THISANDPRIOR
     * @param string $d Date and/or time. Format is : YYYYMMDD['T'HHMMSS[Z]] 
     * @param string $tz Java timezone identifier
     * @return self
     */
    public function __construct(
        $range = null,
        $d = null,
        $tz = null
    )
    {
        parent::__construct();
        if(null !== $range)
        {
            $this->property('range', trim($range));
        }
        if(null !== $d)
        {
            $this->property('d', trim($d));
        }
        if(null !== $tz)
        {
            $this->property('tz', trim($tz));
        }
    }

    /**
     * Gets or sets range
     *
     * @param  string $range
     * @return string|self
     */
    public function range($range = null)
    {
        if(null === $range)
        {
            return $this->property('range');
        }
        return $this->property('range', trim($range));
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
     * Gets or sets tz
     *
     * @param  string $tz
     * @return string|self
     */
    public function tz($tz = null)
    {
        if(null === $tz)
        {
            return $this->property('tz');
        }
        return $this->property('tz', trim($tz));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'inst')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'inst')
    {
        return parent::toXml($name);
    }
}
