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
            $this->setChild('wellKnownTz', $wellKnownTz);
        }
        if($tz instanceof CalTzInfo)
        {
            $this->setChild('tz', $tz);
        }
    }

    /**
     * Gets the wellKnownTz.
     *
     * @return Id
     */
    public function getWellKnownTz()
    {
        return $this->getChild('wellKnownTz');
    }

    /**
     * Sets the wellKnownTz.
     *
     * @param  Id $wellKnownTz
     * @return self
     */
    public function setWellKnownTz(Id $wellKnownTz)
    {
        return $this->setChild('wellKnownTz', $wellKnownTz);
    }

    /**
     * Gets the tz.
     *
     * @return CalTzInfo
     */
    public function getTz()
    {
        return $this->getChild('tz');
    }

    /**
     * Sets the tz.
     *
     * @param  CalTzInfo $tz
     * @return self
     */
    public function setTz(CalTzInfo $tz)
    {
        return $this->setChild('tz', $tz);
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
