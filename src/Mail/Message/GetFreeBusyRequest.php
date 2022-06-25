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
use Zimbra\Mail\Struct\FreeBusyUserSpec;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetFreeBusyRequest class
 * Get Free/Busy information.
 * For freebusyUsers listed using uid,id or name attributes, f/b search will be done for all calendar folders.
 * To view free/busy for a single folder in a particular account, use <usr>
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetFreeBusyRequest extends Request
{
    /**
     * Range start in milliseconds
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $startTime;

    /**
     * Range end in milliseconds
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("integer")
     * @XmlAttribute
     */
    private $endTime;

    /**
     * <b>DEPRECATED</b>.  Comma-separated list of Zimbra IDs or emails.
     * Each value can be a Ziimbra ID or an email.
     * 
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uid;

    /**
     * Comma separated list of Zimbra IDs
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Comma separated list of Emails
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * UID of appointment to exclude from free/busy search
     * @Accessor(getter="getExcludeUid", setter="setExcludeUid")
     * @SerializedName("excludeUid")
     * @Type("string")
     * @XmlAttribute
     */
    private $excludeUid;

    /**
     * To view free/busy for a single folders in particular accounts, use these.
     * 
     * @Accessor(getter="getFreebusyUsers", setter="setFreebusyUsers")
     * @SerializedName("usr")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyUserSpec>")
     * @XmlList(inline=true, entry="usr")
     */
    private $freebusyUsers = [];

    /**
     * Constructor method for GetFreeBusyRequest
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $uid
     * @param  string $id
     * @param  string $name
     * @param  string $excludeUid
     * @param  array $freebusyUsers
     * @return self
     */
    public function __construct(
        int $startTime,
        int $endTime,
        ?string $uid = NULL,
        ?string $id = NULL,
        ?string $name = NULL,
        ?string $excludeUid = NULL,
        array $freebusyUsers = []
    )
    {
        $this->setStartTime($startTime)
             ->setEndTime($endTime)
             ->setFreebusyUsers($freebusyUsers);
        if (NULL !== $uid) {
            $this->setUid($uid);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
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
    public function getStartTime(): int
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
    public function getEndTime(): int
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
     * Gets uid
     *
     * @return string
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * Sets uid
     *
     * @param  string $uid
     * @return self
     */
    public function setUid(string $uid): self
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
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
     * Add usr
     *
     * @param  FreeBusyUserSpec $usr
     * @return self
     */
    public function addFreebusyUser(FreeBusyUserSpec $usr): self
    {
        $this->freebusyUsers[] = $usr;
        return $this;
    }

    /**
     * Sets freebusyUsers
     *
     * @param  array $users
     * @return self
     */
    public function setFreebusyUsers(array $users): self
    {
        $this->freebusyUsers = array_filter($users, static fn ($usr) => $usr instanceof FreeBusyUserSpec);
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
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetFreeBusyEnvelope(
            new GetFreeBusyBody($this)
        );
    }
}
