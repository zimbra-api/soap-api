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
 * DtTimeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DtTimeInfo extends Base
{
    /**
     * Constructor method for DtTimeInfo
     * @param string $d Date and/or time. Format is : YYYYMMDD['T'HHMMSS[Z]] 
     * @param string $tz Java timezone identifier
     * @param int $u UTC time as milliseconds since the epoch. Set if non-all-day
     * @return self
     */
    public function __construct(
        $d = null,
        $tz = null,
        $u = null
    )
    {
        parent::__construct();
        if(null !== $d)
        {
            $this->property('d', trim($d));
        }
        if(null !== $tz)
        {
            $this->property('tz', trim($tz));
        }
        if(null !== $u)
        {
            $this->property('u', (int) $u);
        }
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
     * Gets or sets u
     *
     * @param  int $u
     * @return int|self
     */
    public function u($u = null)
    {
        if(null === $u)
        {
            return $this->property('u');
        }
        return $this->property('u', (int) $u);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dt')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dt')
    {
        return parent::toXml($name);
    }
}