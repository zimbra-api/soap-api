<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Struct\Id;

/**
 * TzReplaceInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $wellKnownTz;

    /**
     * @Accessor(getter="getCalTz", setter="setCalTz")
     * @SerializedName("tz")
     * @Type("Zimbra\Admin\Struct\CalTzInfo")
     * @XmlElement
     */
    private $calTz;

    /**
     * Constructor method for TzReplaceInfo
     * @param TzOnsetInfo $wellKnownTz TzID from /opt/zimbra/conf/timezones.ics 
     * @param TzOnsetInfo $tz Timezone
     * @return self
     */
    public function __construct(Id $wellKnownTz = NULL, CalTzInfo $tz = NULL)
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
    public function getWellKnownTz(): Id
    {
        return $this->wellKnownTz;
    }

    /**
     * Sets the wellKnownTz.
     *
     * @param  Id $wellKnownTz
     * @return self
     */
    public function setWellKnownTz(Id $wellKnownTz): self
    {
        $this->wellKnownTz = $wellKnownTz;
        return $this;
    }

    /**
     * Gets the tz.
     *
     * @return CalTzInfo
     */
    public function getCalTz(): CalTzInfo
    {
        return $this->calTz;
    }

    /**
     * Sets the tz.
     *
     * @param  CalTzInfo $tz
     * @return self
     */
    public function setCalTz(CalTzInfo $tz): self
    {
        $this->calTz = $tz;
        return $this;
    }
}
