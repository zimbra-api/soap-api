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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SoapRequest;

/**
 * GetCalendarItemRequestBase class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
abstract class GetCalendarItemRequestBase extends SoapRequest
{
    /**
     * Set this to return the modified date (md) on the appointment.
     * 
     * @Accessor(getter="getSync", setter="setSync")
     * @SerializedName("sync")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sync;

    /**
     * If set, MIME parts for body content are returned; default unset
     * 
     * @Accessor(getter="getIncludeContent", setter="setIncludeContent")
     * @SerializedName("includeContent")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeContent;

    /**
     * If set, information for each invite is included; default set
     * 
     * @Accessor(getter="getIncludeInvites", setter="setIncludeInvites")
     * @SerializedName("includeInvites")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeInvites;

    /**
     * iCalendar UID
     * Either id or uid should be specified, but not both
     * 
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uid;

    /**
     * Appointment ID.
     * Either id or uid should be specified, but not both
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Constructor method for GetCalendarItemRequestBase
     *
     * @param  bool $sync
     * @param  bool $includeContent
     * @param  bool $includeInvites
     * @param  string $uid
     * @param  string $id
     * @return self
     */
    public function __construct(
        ?bool $sync = NULL,
        ?bool $includeContent = NULL,
        ?bool $includeInvites = NULL,
        ?string $uid = NULL,
        ?string $id = NULL
    )
    {
        if (NULL !== $sync) {
            $this->setSync($sync);
        }
        if (NULL !== $includeContent) {
            $this->setIncludeContent($includeContent);
        }
        if (NULL !== $includeInvites) {
            $this->setIncludeInvites($includeInvites);
        }
        if (NULL !== $uid) {
            $this->setUid($uid);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Gets sync
     *
     * @return bool
     */
    public function getSync(): ?bool
    {
        return $this->sync;
    }

    /**
     * Sets sync
     *
     * @param  bool $sync
     * @return self
     */
    public function setSync(bool $sync): self
    {
        $this->sync = $sync;
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
     * Gets includeContent
     *
     * @return bool
     */
    public function getIncludeContent(): ?bool
    {
        return $this->includeContent;
    }

    /**
     * Sets includeContent
     *
     * @param  bool $includeContent
     * @return self
     */
    public function setIncludeContent(bool $includeContent): self
    {
        $this->includeContent = $includeContent;
        return $this;
    }

    /**
     * Gets includeInvites
     *
     * @return bool
     */
    public function getIncludeInvites(): ?bool
    {
        return $this->includeInvites;
    }

    /**
     * Sets includeInvites
     *
     * @param  bool $includeInvites
     * @return self
     */
    public function setIncludeInvites(bool $includeInvites): self
    {
        $this->includeInvites = $includeInvites;
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
}
