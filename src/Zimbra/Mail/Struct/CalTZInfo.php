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
use Zimbra\Struct\TzOnsetInfo;

/**
 * CalTZInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class CalTZInfo extends Base
{
    /**
     * Constructor method for CalTZInfo
     * @param string $id Timezone ID. If this is the only detail present then this should be an existing server-known timezone's ID Otherwise, it must be present, although it will be ignored by the server
     * @param int $stdoff Standard Time's offset in minutes from UTC; local = UTC + offset
     * @param int $dayoff  Saving Time's offset in minutes from UTC; present only if DST is used
     * @param TzOnsetInfo $standard Time/rule for transitioning from daylight time to standard time. Either specify week/wkday combo, or mday.
     * @param TzOnsetInfo $daylight Time/rule for transitioning from standard time to daylight time
     * @param string $stdname Standard Time component's timezone name
     * @param string $dayname Daylight Saving Time component's timezone name
     * @return self
     */
    public function __construct(
        $id,
        $stdoff,
        $dayoff,
        TzOnsetInfo $standard = null,
        TzOnsetInfo $daylight = null,
        $stdname = null,
        $dayname = null
    )
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->property('stdoff', (int) $stdoff);
        $this->property('dayoff', (int) $dayoff);
        if($standard instanceof TzOnsetInfo)
        {
            $this->child('standard', $standard);
        }
        if($daylight instanceof TzOnsetInfo)
        {
            $this->child('daylight', $daylight);
        }
        if(null !== $stdname)
        {
            $this->property('stdname', trim($stdname));
        }
        if(null !== $dayname)
        {
            $this->property('dayname', trim($dayname));
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
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets stdoff
     *
     * @param  int $stdoff
     * @return int|self
     */
    public function stdoff($stdoff = null)
    {
        if(null === $stdoff)
        {
            return $this->property('stdoff');
        }
        return $this->property('stdoff', (int) $stdoff);
    }

    /**
     * Gets or sets dayoff
     *
     * @param  int $dayoff
     * @return int|self
     */
    public function dayoff($dayoff = null)
    {
        if(null === $dayoff)
        {
            return $this->property('dayoff');
        }
        return $this->property('dayoff', (int) $dayoff);
    }

    /**
     * Gets or sets standard
     *
     * @param  TzOnsetInfo $standard
     * @return TzOnsetInfo|self
     */
    public function standard(TzOnsetInfo $standard = null)
    {
        if(null === $standard)
        {
            return $this->child('standard');
        }
        return $this->child('standard', $standard);
    }

    /**
     * Gets or sets daylight
     *
     * @param  TzOnsetInfo $daylight
     * @return TzOnsetInfo|self
     */
    public function daylight(TzOnsetInfo $daylight = null)
    {
        if(null === $daylight)
        {
            return $this->child('daylight');
        }
        return $this->child('daylight', $daylight);
    }

    /**
     * Gets or sets stdname
     *
     * @param  string $stdname
     * @return string|self
     */
    public function stdname($stdname = null)
    {
        if(null === $stdname)
        {
            return $this->property('stdname');
        }
        return $this->property('stdname', trim($stdname));
    }

    /**
     * Gets or sets dayname
     *
     * @param  string $dayname
     * @return string|self
     */
    public function dayname($dayname = null)
    {
        if(null === $dayname)
        {
            return $this->property('dayname');
        }
        return $this->property('dayname', trim($dayname));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'tz')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'tz')
    {
        return parent::toXml($name);
    }
}
