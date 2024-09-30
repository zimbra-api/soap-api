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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
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
     *
     * @var bool
     */
    #[Accessor(getter: "getSync", setter: "setSync")]
    #[SerializedName("sync")]
    #[Type("bool")]
    #[XmlAttribute]
    private $sync;

    /**
     * If set, MIME parts for body content are returned; default unset
     *
     * @Accessor(getter="getIncludeContent", setter="setIncludeContent")
     * @SerializedName("includeContent")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getIncludeContent", setter: "setIncludeContent")]
    #[SerializedName("includeContent")]
    #[Type("bool")]
    #[XmlAttribute]
    private $includeContent;

    /**
     * If set, information for each invite is included; default set
     *
     * @Accessor(getter="getIncludeInvites", setter="setIncludeInvites")
     * @SerializedName("includeInvites")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getIncludeInvites", setter: "setIncludeInvites")]
    #[SerializedName("includeInvites")]
    #[Type("bool")]
    #[XmlAttribute]
    private $includeInvites;

    /**
     * iCalendar UID
     * Either id or uid should be specified, but not both
     *
     * @Accessor(getter="getUid", setter="setUid")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getUid", setter: "setUid")]
    #[SerializedName("uid")]
    #[Type("string")]
    #[XmlAttribute]
    private $uid;

    /**
     * Appointment ID.
     * Either id or uid should be specified, but not both
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Constructor
     *
     * @param  bool $sync
     * @param  bool $includeContent
     * @param  bool $includeInvites
     * @param  string $uid
     * @param  string $id
     * @return self
     */
    public function __construct(
        ?bool $sync = null,
        ?bool $includeContent = null,
        ?bool $includeInvites = null,
        ?string $uid = null,
        ?string $id = null
    ) {
        if (null !== $sync) {
            $this->setSync($sync);
        }
        if (null !== $includeContent) {
            $this->setIncludeContent($includeContent);
        }
        if (null !== $includeInvites) {
            $this->setIncludeInvites($includeInvites);
        }
        if (null !== $uid) {
            $this->setUid($uid);
        }
        if (null !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Get sync
     *
     * @return bool
     */
    public function getSync(): ?bool
    {
        return $this->sync;
    }

    /**
     * Set sync
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
     * Get includeContent
     *
     * @return bool
     */
    public function getIncludeContent(): ?bool
    {
        return $this->includeContent;
    }

    /**
     * Set includeContent
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
     * Get includeInvites
     *
     * @return bool
     */
    public function getIncludeInvites(): ?bool
    {
        return $this->includeInvites;
    }

    /**
     * Set includeInvites
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
}
