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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\{Id, SoapResponse};

/**
 * CreateCalendarItemResponse class
 * Contains response information for calendar actions (create, modify, reply)
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateCalendarItemResponse extends SoapResponse
{
    /**
     * Appointment ID
     * 
     * @Accessor(getter="getCalItemId", setter="setCalItemId")
     * @SerializedName("calItemId")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getCalItemId', setter: 'setCalItemId')]
    #[SerializedName('calItemId')]
    #[Type('string')]
    #[XmlAttribute]
    private $calItemId;

    /**
     * Appointment ID (deprecated)
     * 
     * @Accessor(getter="getDeprecatedApptId", setter="setDeprecatedApptId")
     * @SerializedName("apptId")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDeprecatedApptId', setter: 'setDeprecatedApptId')]
    #[SerializedName('apptId')]
    #[Type('string')]
    #[XmlAttribute]
    private $deprecatedApptId;

    /**
     * Invite Message ID
     * 
     * @Accessor(getter="getCalInvId", setter="setCalInvId")
     * @SerializedName("invId")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getCalInvId', setter: 'setCalInvId')]
    #[SerializedName('invId')]
    #[Type('string')]
    #[XmlAttribute]
    private $calInvId;

    /**
     * Change sequence
     * 
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getModifiedSequence', setter: 'setModifiedSequence')]
    #[SerializedName('ms')]
    #[Type('int')]
    #[XmlAttribute]
    private $modifiedSequence;

    /**
     * Revision
     * 
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getRevision', setter: 'setRevision')]
    #[SerializedName('rev')]
    #[Type('int')]
    #[XmlAttribute]
    private $revision;

    /**
     * Message information
     * 
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Common\Struct\Id")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Id
     */
    #[Accessor(getter: 'getMsg', setter: 'setMsg')]
    #[SerializedName('m')]
    #[Type(Id::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Id $msg;

    /**
     * Included if "echo" was set in the request
     * 
     * @Accessor(getter="getEcho", setter="setEcho")
     * @SerializedName("echo")
     * @Type("Zimbra\Mail\Struct\CalEcho")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var CalEcho
     */
    #[Accessor(getter: 'getEcho', setter: 'setEcho')]
    #[SerializedName('echo')]
    #[Type(CalEcho::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?CalEcho $echo;

    /**
     * Constructor
     *
     * @param  string $calItemId
     * @param  string $deprecatedApptId
     * @param  string $calInvId
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  Id $msg
     * @param  CalEcho $echo
     * @return self
     */
    public function __construct(
        ?string $calItemId = NULL,
        ?string $deprecatedApptId = NULL,
        ?string $calInvId = NULL,
        ?int $modifiedSequence = NULL,
        ?int $revision = NULL,
        ?Id $msg = NULL,
        ?CalEcho $echo = NULL
    )
    {
        $this->msg = $msg;
        $this->echo = $echo;
        if (NULL !== $calItemId) {
            $this->setCalItemId($calItemId);
        }
        if (NULL !== $deprecatedApptId) {
            $this->setDeprecatedApptId($deprecatedApptId);
        }
        if (NULL !== $calInvId) {
            $this->setCalInvId($calInvId);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $revision) {
            $this->setRevision($revision);
        }
    }

    /**
     * Get calItemId
     *
     * @return string
     */
    public function getCalItemId(): ?string
    {
        return $this->calItemId;
    }

    /**
     * Set calItemId
     *
     * @param  string $calItemId
     * @return self
     */
    public function setCalItemId(string $calItemId): self
    {
        $this->calItemId = $calItemId;
        return $this;
    }

    /**
     * Get deprecatedApptId
     *
     * @return string
     */
    public function getDeprecatedApptId(): ?string
    {
        return $this->deprecatedApptId;
    }

    /**
     * Set deprecatedApptId
     *
     * @param  string $deprecatedApptId
     * @return self
     */
    public function setDeprecatedApptId(string $deprecatedApptId): self
    {
        $this->deprecatedApptId = $deprecatedApptId;
        return $this;
    }

    /**
     * Get calInvId
     *
     * @return string
     */
    public function getCalInvId(): ?string
    {
        return $this->calInvId;
    }

    /**
     * Set calInvId
     *
     * @param  string $calInvId
     * @return self
     */
    public function setCalInvId(string $calInvId): self
    {
        $this->calInvId = $calInvId;
        return $this;
    }

    /**
     * Get modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Set modifiedSequence
     *
     * @param  int $modifiedSequence
     * @return self
     */
    public function setModifiedSequence(int $modifiedSequence): self
    {
        $this->modifiedSequence = $modifiedSequence;
        return $this;
    }

    /**
     * Get revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Set revision
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision(int $revision): self
    {
        $this->revision = $revision;
        return $this;
    }

    /**
     * Get msg
     *
     * @return Id
     */
    public function getMsg(): ?Id
    {
        return $this->msg;
    }

    /**
     * Set msg
     *
     * @param  Id $msg
     * @return self
     */
    public function setMsg(Id $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Get echo
     *
     * @return CalEcho
     */
    public function getEcho(): ?CalEcho
    {
        return $this->echo;
    }

    /**
     * Set echo
     *
     * @param  CalEcho $echo
     * @return self
     */
    public function setEcho(CalEcho $echo): self
    {
        $this->echo = $echo;
        return $this;
    }
}
