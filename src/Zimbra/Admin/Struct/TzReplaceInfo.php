<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Struct\Base;
use Zimbra\Struct\Id;

/**
 * TzReplaceInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzReplaceInfo extends Base
{
    /**
     * Constructor method for TzReplaceInfo
     * @param TzOnsetInfo $wellKnownTz TzID from /opt/zimbra/conf/timezones.ics 
     * @param TzOnsetInfo $tz Timezone
     * @return self
     */
    public function __construct(Id $wellKnownTz = null, CalTzInfo $tz = null)
    {
        parent::__construct();
        if($wellKnownTz instanceof Id)
        {
            $this->child('wellKnownTz', $wellKnownTz);
        }
        if($tz instanceof CalTzInfo)
        {
            $this->child('tz', $tz);
        }
    }

    /**
     * Gets or sets wellKnownTz
     *
     * @param  Id $wellKnownTz
     * @return Id|self
     */
    public function wellKnownTz(Id $wellKnownTz = null)
    {
        if(null === $wellKnownTz)
        {
            return $this->child('wellKnownTz');
        }
        return $this->child('wellKnownTz', $wellKnownTz);
    }

    /**
     * Gets or sets tz
     *
     * @param  CalTzInfo $tz
     * @return CalTzInfo|self
     */
    public function tz(CalTzInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->child('tz');
        }
        return $this->child('tz', $tz);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'replace')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'replace')
    {
        return parent::toXml($name);
    }
}
