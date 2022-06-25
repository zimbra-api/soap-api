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
    ExpandedRecurrenceInvite
};
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * ExpandRecurRequest class
 * Expand recurrences
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ExpandRecurRequest extends Request
{
    /**
     * Start time in milliseconds
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * End time in milliseconds
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("integer")
     * @XmlAttribute
     */
    private $endTime;

    /**
     * Timezone definitions
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @SerializedName("tz")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline=true, entry="tz")
     */
    private $timezones = [];

    /**
     * Specifications for series, modified instances and canceled instances
     * 
     * @Accessor(getter="getInviteComponents", setter="setInviteComponents")
     * @SerializedName("comp")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceInvite>")
     * @XmlList(inline=true, entry="comp")
     */
    private $inviteComponents = [];

    /**
     * Specifications for series, modified instances and canceled instances
     * 
     * @Accessor(getter="getExceptComponents", setter="setExceptComponents")
     * @SerializedName("except")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceException>")
     * @XmlList(inline=true, entry="except")
     */
    private $exceptComponents = [];

    /**
     * Specifications for series, modified instances and canceled instances
     * 
     * @Accessor(getter="getCancelComponents", setter="setCancelComponents")
     * @SerializedName("cancel")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceCancel>")
     * @XmlList(inline=true, entry="cancel")
     */
    private $cancelComponents = [];

    /**
     * Constructor method for ExpandRecurRequest
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  array $timezones
     * @param  array $components
     * @return self
     */
    public function __construct(
        int $startTime,
        int $endTime,
        array $timezones = [],
        array $components = []
    )
    {
        $this->setStartTime($startTime)
             ->setEndTime($endTime)
             ->setTimezones($timezones)
             ->setComponents($components);
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
        $this->timezones = array_filter($timezones, static fn ($timezone) => $timezone instanceof CalTZInfo);
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
        if ($component instanceof ExpandedRecurrenceInvite) {
            $this->inviteComponents[] = $component;
        }
        if ($component instanceof ExpandedRecurrenceException) {
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
     * @param  array $components
     * @return self
     */
    public function setCancelComponents(array $components): self
    {
        $this->cancelComponents = array_filter($components, static fn ($cancel) => $cancel instanceof ExpandedRecurrenceCancel);
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
     * @param  array $components
     * @return self
     */
    public function setInviteComponents(array $components): self
    {
        $this->inviteComponents = array_filter($components, static fn ($comp) => $comp instanceof ExpandedRecurrenceInvite);
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
     * @param  array $components
     * @return self
     */
    public function setExceptComponents(array $components): self
    {
        $this->exceptComponents = array_filter($components, static fn ($except) => $except instanceof ExpandedRecurrenceException);
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new ExpandRecurEnvelope(
            new ExpandRecurBody($this)
        );
    }
}
