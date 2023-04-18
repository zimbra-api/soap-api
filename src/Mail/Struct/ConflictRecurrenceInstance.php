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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * ConflictRecurrenceInstance class
 * Information on conflicting instances
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConflictRecurrenceInstance extends ExpandedRecurrenceInstance
{
    /**
     * Free/Busy user status
     * 
     * @Accessor(getter="getFreebusyUsers", setter="setFreebusyUsers")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyUserStatus>")
     * @XmlList(inline=true, entry="usr", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getFreebusyUsers', setter: 'setFreebusyUsers')]
    #[Type('array<Zimbra\Mail\Struct\FreeBusyUserStatus>')]
    #[XmlList(inline: true, entry: 'usr', namespace: 'urn:zimbraMail')]
    private $freebusyUsers = [];

    /**
     * Constructor
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
     * Set freebusyUsers
     *
     * @param  array $users
     * @return self
     */
    public function setFreebusyUsers(array $users): self
    {
        $this->freebusyUsers = array_filter(
            $users, static fn ($user) => $user instanceof FreeBusyUserStatus
        );
        return $this;
    }

    /**
     * Get freebusyUsers
     *
     * @return array
     */
    public function getFreebusyUsers(): array
    {
        return $this->freebusyUsers;
    }
}
