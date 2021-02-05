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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

use Zimbra\Struct\Id;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateCalendarItemResponse class
 * Contains response information for calendar actions (create, modify, reply)
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="response")
 */
class CreateCalendarItemResponse implements ResponseInterface
{
    /**
     * Appointment ID
     * @Accessor(getter="getCalItemId", setter="setCalItemId")
     * @SerializedName("calItemId")
     * @Type("string")
     * @XmlAttribute
     */
    private $calItemId;

    /**
     * Appointment ID (deprecated)
     * @Accessor(getter="getDeprecatedApptId", setter="setDeprecatedApptId")
     * @SerializedName("apptId")
     * @Type("string")
     * @XmlAttribute
     */
    private $deprecatedApptId;

    /**
     * Invite Message ID
     * @Accessor(getter="getCalInvId", setter="setCalInvId")
     * @SerializedName("invId")
     * @Type("string")
     * @XmlAttribute
     */
    private $calInvId;

    /**
     * Change sequence
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modifiedSequence;

    /**
     * Revision
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("integer")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Message information
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Struct\Id")
     * @XmlElement
     */
    private $msg;

    /**
     * Included if "echo" was set in the request
     * @Accessor(getter="getEcho", setter="setEcho")
     * @SerializedName("echo")
     * @Type("Zimbra\Mail\Struct\CalEcho")
     * @XmlElement
     */
    private $echo;

    /**
     * Constructor method for CreateCalendarItemResponse
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
        if ($msg instanceof Id) {
            $this->setMsg($msg);
        }
        if ($echo instanceof CalEcho) {
            $this->setEcho($echo);
        }
    }

    /**
     * Gets calItemId
     *
     * @return string
     */
    public function getCalItemId(): ?string
    {
        return $this->calItemId;
    }

    /**
     * Sets calItemId
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
     * Gets deprecatedApptId
     *
     * @return string
     */
    public function getDeprecatedApptId(): ?string
    {
        return $this->deprecatedApptId;
    }

    /**
     * Sets deprecatedApptId
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
     * Gets calInvId
     *
     * @return string
     */
    public function getCalInvId(): ?string
    {
        return $this->calInvId;
    }

    /**
     * Sets calInvId
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
     * Gets modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Sets modifiedSequence
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
     * Gets revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Sets revision
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
     * Gets msg
     *
     * @return Id
     */
    public function getMsg(): ?Id
    {
        return $this->msg;
    }

    /**
     * Sets msg
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
     * Gets echo
     *
     * @return CalEcho
     */
    public function getEcho(): ?CalEcho
    {
        return $this->echo;
    }

    /**
     * Sets echo
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