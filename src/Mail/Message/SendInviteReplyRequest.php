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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\{CalTZInfo, DtTimeInfo, Msg};
use Zimbra\Common\Enum\VerbType;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SendInviteReplyRequest class
 * Send a reply to an invite
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SendInviteReplyRequest extends SoapRequest
{
    /**
     * Unique ID of the invite (and component therein) you are replying to
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
     * component number of the invite
     * 
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("comp")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getComponentNum', setter: 'setComponentNum')]
    #[SerializedName('comp')]
    #[Type('int')]
    #[XmlAttribute]
    private $componentNum;

    /**
     * Verb - ACCEPT, DECLINE, TENTATIVE, COMPLETED, DELEGATED
     * (Completed/Delegated are NOT supported as of 9/12/2005)
     * 
     * @Accessor(getter="getVerb", setter="setVerb")
     * @SerializedName("verb")
     * @Type("Enum<Zimbra\Common\Enum\VerbType>")
     * @XmlAttribute
     * 
     * @var VerbType
     */
    #[Accessor(getter: 'getVerb', setter: 'setVerb')]
    #[SerializedName('verb')]
    #[Type('Enum<Zimbra\Common\Enum\VerbType>')]
    #[XmlAttribute]
    private VerbType $verb;

    /**
     * Update organizer. true by default. if false then only make the update locally.
     * Note that earlier documentation implied incorrectly that if this was false it would be ignored and treated
     * as being true if an <m> element is present.
     * Also take a note that, if RSVP setting in original invite is not present or FALSE then updateOrganizer will be treated as FALSE.
     * 
     * @Accessor(getter="getUpdateOrganizer", setter="setUpdateOrganizer")
     * @SerializedName("updateOrganizer")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getUpdateOrganizer', setter: 'setUpdateOrganizer')]
    #[SerializedName('updateOrganizer')]
    #[Type('bool')]
    #[XmlAttribute]
    private $updateOrganizer;

    /**
     * Identity ID to use to send reply
     * 
     * @Accessor(getter="getIdentityId", setter="setIdentityId")
     * @SerializedName("idnt")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getIdentityId', setter: 'setIdentityId')]
    #[SerializedName('idnt')]
    #[Type('string')]
    #[XmlAttribute]
    private $identityId;

    /**
     * If supplied then reply to just one instance of the specified Invite (default is all instances)
     * 
     * @Accessor(getter="getExceptionId", setter="setExceptionId")
     * @SerializedName("exceptId")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var DtTimeInfo
     */
    #[Accessor(getter: 'getExceptionId', setter: 'setExceptionId')]
    #[SerializedName('exceptId')]
    #[Type(DtTimeInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?DtTimeInfo $exceptionId;

    /**
     * Definition for TZID referenced by DATETIME in <exceptId>
     * 
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("tz")
     * @Type("Zimbra\Mail\Struct\CalTZInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var CalTZInfo
     */
    #[Accessor(getter: 'getTimezone', setter: 'setTimezone')]
    #[SerializedName('tz')]
    #[Type(CalTZInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?CalTZInfo $timezone;

    /**
     * Embedded message, if the user wants to send a custom update message.
     * The client is responsible for setting the message recipient list in this case (which should include Organizer,
     * if the client wants to tell the organizer about this response)
     * 
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\Msg")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Msg
     */
    #[Accessor(getter: 'getMsg', setter: 'setMsg')]
    #[SerializedName('m')]
    #[Type(Msg::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Msg $msg;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  int $componentNum
     * @param  VerbType $verb
     * @param  bool $updateOrganizer
     * @param  string $identityId
     * @param  Msg $msg
     * @return self
     */
    public function __construct(
        string $id = '',
        int $componentNum = 0,
        ?VerbType $verb = NULL,
        ?bool $updateOrganizer = NULL,
        ?string $identityId = NULL,
        ?DtTimeInfo $exceptionId = NULL,
        ?CalTZInfo $timezone = NULL,
        ?Msg $msg = NULL
    )
    {
        $this->setId($id)
             ->setComponentNum($componentNum)
             ->setVerb($verb ?? new VerbType('ACCEPT'));
        $this->exceptionId = $exceptionId;
        $this->timezone = $timezone;
        $this->msg = $msg;
        if (NULL !== $updateOrganizer) {
            $this->setUpdateOrganizer($updateOrganizer);
        }
        if (NULL !== $identityId) {
            $this->setIdentityId($identityId);
        }
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
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set componentNum
     *
     * @param  int $componentNum
     * @return self
     */
    public function setComponentNum(int $componentNum): self
    {
        $this->componentNum = $componentNum;
        return $this;
    }

    /**
     * Get componentNum
     *
     * @return int
     */
    public function getComponentNum(): ?int
    {
        return $this->componentNum;
    }

    /**
     * Set verb
     *
     * @param  VerbType $verb
     * @return self
     */
    public function setVerb(VerbType $verb): self
    {
        $this->verb = $verb;
        return $this;
    }

    /**
     * Get verb
     *
     * @return VerbType
     */
    public function getVerb(): VerbType
    {
        return $this->verb;
    }

    /**
     * Set updateOrganizer
     *
     * @param  bool $updateOrganizer
     * @return self
     */
    public function setUpdateOrganizer(bool $updateOrganizer): self
    {
        $this->updateOrganizer = $updateOrganizer;
        return $this;
    }

    /**
     * Get updateOrganizer
     *
     * @return bool
     */
    public function getUpdateOrganizer(): ?bool
    {
        return $this->updateOrganizer;
    }

    /**
     * Set identityId
     *
     * @param  string $identityId
     * @return self
     */
    public function setIdentityId(string $identityId): self
    {
        $this->identityId = $identityId;
        return $this;
    }

    /**
     * Get identityId
     *
     * @return string
     */
    public function getIdentityId(): ?string
    {
        return $this->identityId;
    }

    /**
     * Set exceptionId
     *
     * @param  DtTimeInfo $exceptionId
     * @return self
     */
    public function setExceptionId(DtTimeInfo $exceptionId): self
    {
        $this->exceptionId = $exceptionId;
        return $this;
    }

    /**
     * Get exceptionId
     *
     * @return DtTimeInfo
     */
    public function getExceptionId(): ?DtTimeInfo
    {
        return $this->exceptionId;
    }

    /**
     * Set timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function setTimezone(CalTZInfo $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Get timezone
     *
     * @return CalTZInfo
     */
    public function getTimezone(): ?CalTZInfo
    {
        return $this->timezone;
    }

    /**
     * Set msg
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Get msg
     *
     * @return Msg
     */
    public function getMsg(): ?Msg
    {
        return $this->msg;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SendInviteReplyEnvelope(
            new SendInviteReplyBody($this)
        );
    }
}
