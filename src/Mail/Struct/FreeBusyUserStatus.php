<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

use Zimbra\Enum\FreeBusyStatus;

/**
 * FreeBusyUserStatus class
 * Free/Busy user status
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="usr")
 */
class FreeBusyUserStatus
{
    /**
     * Email address for a user who has a conflict with the instance
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Free/Busy status - B|T|O (Busy, Tentative or Out-of-office)
     * @Accessor(getter="getFreebusyStatus", setter="setFreebusyStatus")
     * @SerializedName("fb")
     * @Type("Zimbra\Enum\FreeBusyStatus")
     * @XmlAttribute
     */
    private $freebusyStatus;

    /**
     * Constructor method for FreeBusyUserStatus
     *
     * @param  string $name
     * @param  FreeBusyStatus $freebusyStatus
     * @return self
     */
    public function __construct(string $name, FreeBusyStatus $freebusyStatus)
    {
        $this->setName($name)
             ->setFreebusyStatus($freebusyStatus);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets freebusyStatus
     *
     * @return FreeBusyStatus
     */
    public function getFreebusyStatus(): FreeBusyStatus
    {
        return $this->freebusyStatus;
    }

    /**
     * Sets freebusyStatus
     *
     * @param  FreeBusyStatus $freebusyStatus
     * @return self
     */
    public function setFreebusyStatus(FreeBusyStatus $freebusyStatus): self
    {
        $this->freebusyStatus = $freebusyStatus;
        return $this;
    }
}
