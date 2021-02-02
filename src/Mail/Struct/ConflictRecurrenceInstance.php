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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};

/**
 * ConflictRecurrenceInstance class
 * Information on conflicting instances
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="inst")
 */
class ConflictRecurrenceInstance extends ExpandedRecurrenceInstance
{
    /**
     * Free/Busy user status
     * @Accessor(getter="getFreebusyUsers", setter="setFreebusyUsers")
     * @SerializedName("usr")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyUserStatus>")
     * @XmlList(inline = true, entry = "usr")
     */
    private $freebusyUsers = [];

    /**
     * Constructor method for ConflictRecurrenceInstance
     *
     * @param  array $freebusyUsers
     * @param  int $startTime
     * @param  int $duration
     * @param  bool $allDay
     * @param  int $tzOffset
     * @param  string $recurIdZ
     * @return self
     */
    public function __construct(
        array $freebusyUsers = [],
        ?int $startTime = NULL,
        ?int $duration = NULL,
        ?bool $allDay = NULL,
        ?int $tzOffset = NULL,
        ?string $recurIdZ = NULL
    )
    {
        parent::__construct($startTime, $duration, $allDay, $tzOffset, $recurIdZ);
        $this->setFreebusyUsers($freebusyUsers);
    }

    /**
     * Sets freebusyUsers
     *
     * @param  array $freebusyUsers
     * @return self
     */
    public function setFreebusyUsers(array $freebusyUsers): self
    {
        $this->freebusyUsers = [];
        foreach ($freebusyUsers as $freebusyUser) {
            if ($freebusyUser instanceof FreeBusyUserStatus) {
                $this->freebusyUsers[] = $freebusyUser;
            }
        }
        return $this;
    }

    /**
     * Gets freebusyUsers
     *
     * @return array
     */
    public function getFreebusyUsers(): array
    {
        return $this->freebusyUsers;
    }

    /**
     * Add freebusyUser
     *
     * @param  FreeBusyUserStatus $freebusyUser
     * @return self
     */
    public function addFreebusyUser(FreeBusyUserStatus $freebusyUser): self
    {
        $this->freebusyUsers[] = $freebusyUser;
        return $this;
    }
}
