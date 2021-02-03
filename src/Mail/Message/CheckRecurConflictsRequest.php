<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceComponent;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\FreeBusyUserSpec;
use Zimbra\Soap\Request;

/**
 * CheckRecurConflictsRequest class
 * Check conflicts in recurrence against list of users.
 * Set {all} attribute to get all instances, even those without conflicts.  By default only instances that have
 * conflicts are returned.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckRecurConflictsRequest")
 */
class CheckRecurConflictsRequest extends Request
{
    /**
     * Start time in millis.  If not specified, defaults to current time
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * End time in millis.  If not specified, unlimited
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("integer")
     * @XmlAttribute
     */
    private $endTime;

    /**
     * Set this to get all instances, even those without conflicts.  By default only
     * instances that have conflicts are returned.
     * @Accessor(getter="getAllInstances", setter="setAllInstances")
     * @SerializedName("all")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allInstances;

    /**
     * UID of appointment to exclude from free/busy search
     * @Accessor(getter="getExcludeUid", setter="setExcludeUid")
     * @SerializedName("excludeUid")
     * @Type("string")
     * @XmlAttribute
     */
    private $excludeUid;

    /**
     * Timezones
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @SerializedName("tz")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline = true, entry = "tz")
     */
    private $timezones;

    /**
     * Cancel expanded recurrences
     * 
     * @Accessor(getter="getCancelComponents", setter="setCancelComponents")
     * @SerializedName("cancel")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceCancel>")
     * @XmlList(inline = true, entry = "cancel")
     */
    private $cancelComponents;

    /**
     * Invite expanded recurrences
     * 
     * @Accessor(getter="getInviteComponents", setter="setInviteComponents")
     * @SerializedName("comp")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceInvite>")
     * @XmlList(inline = true, entry = "comp")
     */
    private $inviteComponents;

    /**
     * Except expanded recurrences
     * 
     * @Accessor(getter="getExceptComponents", setter="setExceptComponents")
     * @SerializedName("except")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceException>")
     * @XmlList(inline = true, entry = "except")
     */
    private $exceptComponents;

    /**
     * Freebusy user specifications
     * 
     * @Accessor(getter="getFreebusyUsers", setter="setFreebusyUsers")
     * @SerializedName("usr")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyUserSpec>")
     * @XmlList(inline = true, entry = "usr")
     */
    private $freebusyUsers;

    /**
     * Constructor method for CheckRecurConflictsRequest
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  bool $allInstances
     * @param  string $excludeUid
     * @param  array $timezones
     * @param  array $components
     * @param  array $freebusyUsers
     * @return self
     */
    public function __construct(
        ?int $startTime = NULL,
        ?int $endTime = NULL,
        ?bool $allInstances = NULL,
        ?string $excludeUid = NULL,
        array $timezones = [],
        array $components = [],
        array $freebusyUsers = []
    )
    {
        $this->setTimezones($timezones)
             ->setComponents($components)
             ->setFreebusyUsers($freebusyUsers);
        if (NULL !== $startTime) {
            $this->setStartTime($startTime);
        }
        if (NULL !== $endTime) {
            $this->setEndTime($endTime);
        }
        if (NULL !== $allInstances) {
            $this->setAllInstances($allInstances);
        }
        if (NULL !== $excludeUid) {
            $this->setExcludeUid($excludeUid);
        }
    }

    /**
     * Gets startTime
     *
     * @return int
     */
    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    /**
     * Sets startTime
     *
     * @param  int $startTime
     * @return self
     */
    public function setStartTime(int $startTime): self
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Gets endTime
     *
     * @return int
     */
    public function getEndTime(): ?int
    {
        return $this->endTime;
    }

    /**
     * Sets endTime
     *
     * @param  int $endTime
     * @return self
     */
    public function setEndTime(int $endTime): self
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Gets allInstances
     *
     * @return bool
     */
    public function getAllInstances(): ?bool
    {
        return $this->allInstances;
    }

    /**
     * Sets allInstances
     *
     * @param  bool $allInstances
     * @return self
     */
    public function setAllInstances(bool $allInstances): self
    {
        $this->allInstances = $allInstances;
        return $this;
    }

    /**
     * Gets excludeUid
     *
     * @return string
     */
    public function getExcludeUid(): ?string
    {
        return $this->excludeUid;
    }

    /**
     * Sets excludeUid
     *
     * @param  string $excludeUid
     * @return self
     */
    public function setExcludeUid(string $excludeUid): self
    {
        $this->excludeUid = $excludeUid;
        return $this;
    }

    /**
     * Add timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function addTimezone(CalTZInfo $timezone): self
    {
        $this->timezones[] = $timezone;
        return $this;
    }

    /**
     * Sets timezones
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones): self
    {
        $this->timezones = [];
        foreach ($timezones as $timezone) {
            if ($timezone instanceof CalTZInfo) {
                $this->timezones[] = $timezone;
            }
        }
        return $this;
    }

    /**
     * Gets timezones
     *
     * @return array
     */
    public function getTimezones(): array
    {
        return $this->timezones;
    }

    /**
     * Add component
     *
     * @param  ExpandedRecurrenceComponent $component
     * @return self
     */
    public function addComponent(ExpandedRecurrenceComponent $component): self
    {
        if ($component instanceof ExpandedRecurrenceCancel) {
            $this->cancelComponents[] = $component;
        }
        else if ($component instanceof ExpandedRecurrenceInvite) {
            $this->inviteComponents[] = $component;
        }
        else if ($component instanceof ExpandedRecurrenceException) {
            $this->exceptComponents[] = $component;
        }
        return $this;
    }

    /**
     * Sets components
     *
     * @param  array $components
     * @return self
     */
    public function setComponents(array $components): self
    {
        $this->cancelComponents = $this->inviteComponents = $this->exceptComponents = [];
        foreach ($components as $component) {
            if ($component instanceof ExpandedRecurrenceComponent) {
                $this->addComponent($component);
            }
        }
        return $this;
    }

    /**
     * Gets components
     *
     * @return array
     */
    public function getComponents(): array
    {
        return array_merge($this->cancelComponents, $this->inviteComponents, $this->exceptComponents);
    }

    /**
     * Sets cancelComponents
     *
     * @param  array $cancelComponents
     * @return self
     */
    public function setCancelComponents(array $cancelComponents): self
    {
        $this->cancelComponents = [];
        foreach ($cancelComponents as $cancelComponent) {
            if ($cancelComponent instanceof ExpandedRecurrenceCancel) {
                $this->cancelComponents[] = $cancelComponent;
            }
        }
        return $this;
    }

    /**
     * Gets cancelComponents
     *
     * @return array
     */
    public function getCancelComponents(): array
    {
        return $this->cancelComponents;
    }

    /**
     * Sets inviteComponents
     *
     * @param  array $inviteComponents
     * @return self
     */
    public function setInviteComponents(array $inviteComponents): self
    {
        $this->inviteComponents = [];
        foreach ($inviteComponents as $inviteComponent) {
            if ($inviteComponent instanceof ExpandedRecurrenceInvite) {
                $this->inviteComponents[] = $inviteComponent;
            }
        }
        return $this;
    }

    /**
     * Gets inviteComponents
     *
     * @return array
     */
    public function getInviteComponents(): array
    {
        return $this->inviteComponents;
    }

    /**
     * Sets exceptComponents
     *
     * @param  array $exceptComponents
     * @return self
     */
    public function setExceptComponents(array $exceptComponents): self
    {
        $this->exceptComponents = [];
        foreach ($exceptComponents as $exceptComponent) {
            if ($exceptComponent instanceof ExpandedRecurrenceException) {
                $this->exceptComponents[] = $exceptComponent;
            }
        }
        return $this;
    }

    /**
     * Gets exceptComponents
     *
     * @return array
     */
    public function getExceptComponents(): array
    {
        return $this->exceptComponents;
    }

    /**
     * Add freebusyUser
     *
     * @param  FreeBusyUserSpec $freebusyUser
     * @return self
     */
    public function addFreebusyUser(FreeBusyUserSpec $freebusyUser): self
    {
        $this->freebusyUsers[] = $freebusyUser;
        return $this;
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
            if ($freebusyUser instanceof FreeBusyUserSpec) {
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CheckRecurConflictsEnvelope)) {
            $this->envelope = new CheckRecurConflictsEnvelope(
                new CheckRecurConflictsBody($this)
            );
        }
    }
}
