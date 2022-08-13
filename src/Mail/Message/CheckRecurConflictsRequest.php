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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Mail\Struct\{
    CalTZInfo,
    ExpandedRecurrenceCancel,
    ExpandedRecurrenceComponent,
    ExpandedRecurrenceException,
    ExpandedRecurrenceInvite,
    FreeBusyUserSpec
};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckRecurConflictsRequest extends SoapRequest
{
    /**
     * Start time in millis.  If not specified, defaults to current time
     * 
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * End time in millis.  If not specified, unlimited
     * 
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("int")
     * @XmlAttribute
     */
    private $endTime;

    /**
     * Set this to get all instances, even those without conflicts.  By default only
     * instances that have conflicts are returned.
     * 
     * @Accessor(getter="getAllInstances", setter="setAllInstances")
     * @SerializedName("all")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allInstances;

    /**
     * UID of appointment to exclude from free/busy search
     * 
     * @Accessor(getter="getExcludeUid", setter="setExcludeUid")
     * @SerializedName("excludeUid")
     * @Type("string")
     * @XmlAttribute
     */
    private $excludeUid;

    /**
     * Timezones
     * 
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline=true, entry="tz", namespace="urn:zimbraMail")
     */
    private $timezones = [];

    /**
     * Cancel expanded recurrences
     * 
     * @Accessor(getter="getCancelComponents", setter="setCancelComponents")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceCancel>")
     * @XmlList(inline=true, entry="cancel", namespace="urn:zimbraMail")
     */
    private $cancelComponents = [];

    /**
     * Invite expanded recurrences
     * 
     * @Accessor(getter="getInviteComponents", setter="setInviteComponents")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceInvite>")
     * @XmlList(inline=true, entry="comp", namespace="urn:zimbraMail")
     */
    private $inviteComponents = [];

    /**
     * Except expanded recurrences
     * 
     * @Accessor(getter="getExceptComponents", setter="setExceptComponents")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceException>")
     * @XmlList(inline=true, entry="except", namespace="urn:zimbraMail")
     */
    private $exceptComponents = [];

    /**
     * Freebusy user specifications
     * 
     * @Accessor(getter="getFreebusyUsers", setter="setFreebusyUsers")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyUserSpec>")
     * @XmlList(inline=true, entry="usr", namespace="urn:zimbraMail")
     */
    private $freebusyUsers = [];

    /**
     * Constructor
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
     * Get startTime
     *
     * @return int
     */
    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    /**
     * Set startTime
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
     * Get endTime
     *
     * @return int
     */
    public function getEndTime(): ?int
    {
        return $this->endTime;
    }

    /**
     * Set endTime
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
     * Get allInstances
     *
     * @return bool
     */
    public function getAllInstances(): ?bool
    {
        return $this->allInstances;
    }

    /**
     * Set allInstances
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
     * Get excludeUid
     *
     * @return string
     */
    public function getExcludeUid(): ?string
    {
        return $this->excludeUid;
    }

    /**
     * Set excludeUid
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
     * Set timezones
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones): self
    {
        $this->timezones = array_filter($timezones, static fn ($timezone) => $timezone instanceof CalTZInfo);
        return $this;
    }

    /**
     * Get timezones
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
     * Set components
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
     * Get components
     *
     * @return array
     */
    public function getComponents(): array
    {
        return array_merge($this->cancelComponents, $this->inviteComponents, $this->exceptComponents);
    }

    /**
     * Set cancelComponents
     *
     * @param  array $components
     * @return self
     */
    public function setCancelComponents(array $components): self
    {
        $this->cancelComponents = array_filter($components, static fn ($component) => $component instanceof ExpandedRecurrenceCancel);
        return $this;
    }

    /**
     * Get cancelComponents
     *
     * @return array
     */
    public function getCancelComponents(): array
    {
        return $this->cancelComponents;
    }

    /**
     * Set inviteComponents
     *
     * @param  array $components
     * @return self
     */
    public function setInviteComponents(array $components): self
    {
        $this->inviteComponents = array_filter($components, static fn ($component) => $component instanceof ExpandedRecurrenceInvite);
        return $this;
    }

    /**
     * Get inviteComponents
     *
     * @return array
     */
    public function getInviteComponents(): array
    {
        return $this->inviteComponents;
    }

    /**
     * Set exceptComponents
     *
     * @param  array $components
     * @return self
     */
    public function setExceptComponents(array $components): self
    {
        $this->exceptComponents = array_filter($components, static fn ($component) => $component instanceof ExpandedRecurrenceException);
        return $this;
    }

    /**
     * Get exceptComponents
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
     * Set freebusyUsers
     *
     * @param  array $users
     * @return self
     */
    public function setFreebusyUsers(array $users): self
    {
        $this->freebusyUsers = array_filter($users, static fn ($user) => $user instanceof FreeBusyUserSpec);
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

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckRecurConflictsEnvelope(
            new CheckRecurConflictsBody($this)
        );
    }
}
