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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\Id;

/**
 * TzReplaceInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="replace")
 */
class TzReplaceInfo
{
    /**
     * @Accessor(getter="getWellKnownTz", setter="setWellKnownTz")
     * @SerializedName("wellKnownTz")
     * @Type("Zimbra\Struct\Id")
     * @XmlElement
     */
    private $_wellKnownTz;

    /**
     * @Accessor(getter="getCalTz", setter="setCalTz")
     * @SerializedName("tz")
     * @Type("Zimbra\Admin\Struct\CalTzInfo")
     * @XmlElement
     */
    private $_calTz;

    /**
     * Constructor method for TzReplaceInfo
     * @param TzOnsetInfo $wellKnownTz TzID from /opt/zimbra/conf/timezones.ics 
     * @param TzOnsetInfo $tz Timezone
     * @return self
     */
    public function __construct(Id $wellKnownTz = null, CalTzInfo $tz = null)
    {
        if ($wellKnownTz instanceof Id) {
            $this->setWellKnownTz($wellKnownTz);
        }
        if ($tz instanceof CalTzInfo) {
            $this->setCalTz($tz);
        }
    }

    /**
     * Gets the wellKnownTz.
     *
     * @return Id
     */
    public function getWellKnownTz()
    {
        return $this->_wellKnownTz;
    }

    /**
     * Sets the wellKnownTz.
     *
     * @param  Id $wellKnownTz
     * @return self
     */
    public function setWellKnownTz(Id $wellKnownTz)
    {
        $this->_wellKnownTz = $wellKnownTz;
        return $this;
    }

    /**
     * Gets the tz.
     *
     * @return CalTzInfo
     */
    public function getCalTz()
    {
        return $this->_calTz;
    }

    /**
     * Sets the tz.
     *
     * @param  CalTzInfo $tz
     * @return self
     */
    public function setCalTz(CalTzInfo $tz)
    {
        $this->_calTz = $tz;
        return $this;
    }
}
