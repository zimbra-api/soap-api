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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetFreeBusyRequest extends SoapRequest
{
    /**
     * Range start in milliseconds
     * 
     * @Accessor(getter="getStartTime", setter="setStartTime")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getStartTime', setter: 'setStartTime')]
    #[SerializedName('s')]
    #[Type('int')]
    #[XmlAttribute]
    private $startTime;

    /**
     * Range end in milliseconds
     * 
     * @Accessor(getter="getEndTime", setter="setEndTime")
     * @SerializedName("e")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getEndTime', setter: 'setEndTime')]
    #[SerializedName('e')]
    #[Type('int')]
    #[XmlAttribute]
    private $endTime;

    /**
     * DEPRECATED. Comma-separated list of Zimbra IDs or emails.
     * Each value can be a Ziimbra ID or an email.
     * 
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getUid', setter: 'setUid')]
    #[SerializedName('uid')]
    #[Type('string')]
    #[XmlAttribute]
    private $uid;

    /**
     * Comma separated list of Zimbra IDs
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Comma separated list of emails
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * UID of appointment to exclude from free/busy search
     * 
     * @Accessor(getter="getExcludeUid", setter="setExcludeUid")
     * @SerializedName("excludeUid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getExcludeUid', setter: 'setExcludeUid')]
    #[SerializedName('excludeUid')]
    #[Type('string')]
    #[XmlAttribute]
    private $excludeUid;

    /**
     * To view free/busy for a single folders in particular accounts, use these.
     * 
     * @Accessor(getter="getFreebusyUsers", setter="setFreebusyUsers")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyUserSpec>")
     * @XmlList(inline=true, entry="usr", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getFreebusyUsers', setter: 'setFreebusyUsers')]
    #[Type('array<Zimbra\Mail\Struct\FreeBusyUserSpec>')]
    #[XmlList(inline: true, entry: 'usr', namespace: 'urn:zimbraMail')]
    private $freebusyUsers = [];

    /**
     * Constructor
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
        int $startTime = 0,
        int $endTime = 0,
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
     * Get startTime
     *
     * @return int
     */
    public function getStartTime(): int
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
    public function getEndTime(): int
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
     * Get uid
     *
     * @return string
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * Set uid
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
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Set freebusyUsers
     *
     * @param  array $users
     * @return self
     */
    public function setFreebusyUsers(array $users): self
    {
        $this->freebusyUsers = array_filter(
            $users, static fn ($usr) => $usr instanceof FreeBusyUserSpec
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

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetFreeBusyEnvelope(
            new GetFreeBusyBody($this)
        );
    }
}
