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
use Zimbra\Common\Struct\{AttributeName, Id};
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetContactsRequest class
 * Get contac
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetContactsRequest extends Request
{
    /**
     * If set, return modified date (md) on contacts.
     * 
     * @Accessor(getter="getSync", setter="setSync")
     * @SerializedName("sync")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sync;

    /**
     * If is present, return only contacts in the specified folder.
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Sort by
     * 
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortBy;

    /**
     * If set, deref contact group members.
     * 
     * @Accessor(getter="getDerefGroupMember", setter="setDerefGroupMember")
     * @SerializedName("derefGroupMember")
     * @Type("bool")
     * @XmlAttribute
     */
    private $derefGroupMember;

    /**
     * If set, Include the list of contact groups this contact is a member of.
     * 
     * @Accessor(getter="getIncludeMemberOf", setter="setIncludeMemberOf")
     * @SerializedName("memberOf")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeMemberOf;

    /**
     * Whether to return contact hidden attrs defined in zimbraContactHiddenAttributes
     * 
     * @Accessor(getter="getReturnHiddenAttrs", setter="setReturnHiddenAttrs")
     * @SerializedName("returnHiddenAttrs")
     * @Type("bool")
     * @XmlAttribute
     */
    private $returnHiddenAttrs;

    /**
     * Whether to return smime certificate info
     * 
     * @Accessor(getter="getReturnCertInfo", setter="setReturnCertInfo")
     * @SerializedName("returnCertInfo")
     * @Type("bool")
     * @XmlAttribute
     */
    private $returnCertInfo;

    /**
     * Set to return IMAP UID.  (default is unset.)
     * 
     * @Accessor(getter="getWantImapUid", setter="setWantImapUid")
     * @SerializedName("wantImapUid")
     * @Type("bool")
     * @XmlAttribute
     */
    private $wantImapUid;

    /**
     * Max members
     * 
     * @Accessor(getter="getMaxMembers", setter="setMaxMembers")
     * @SerializedName("maxMembers")
     * @Type("integer")
     * @XmlAttribute
     */
    private $maxMembers;

    /**
     * Attrs - if present, return only the specified attribute(s).
     * 
     * @Accessor(getter="getAttributes", setter="setAttributes")
     * @Type("array<Zimbra\Common\Struct\AttributeName>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraMail")
     */
    private $attributes = [];

    /**
     * If present, return only the specified attribute(s) for derefed members, applicable
     * only when derefGroupMember is set.
     * 
     * @Accessor(getter="getMemberAttributes", setter="setMemberAttributes")
     * @Type("array<Zimbra\Common\Struct\AttributeName>")
     * @XmlList(inline=true, entry="ma", namespace="urn:zimbraMail")
     */
    private $memberAttributes = [];

    /**
     * If present, only get the specified contact(s).
     * 
     * @Accessor(getter="getContacts", setter="setContacts")
     * @Type("array<Zimbra\Common\Struct\Id>")
     * @XmlList(inline=true, entry="cn", namespace="urn:zimbraMail")
     */
    private $contacts = [];

    /**
     * Constructor method for GetContactsRequest
     *
     * @param  bool $sync
     * @param  string $folderId
     * @param  string $sortBy
     * @param  bool $derefGroupMember
     * @param  bool $includeMemberOf
     * @return self
     */
    public function __construct(
        ?bool $sync = NULL,
        ?string $folderId = NULL,
        ?string $sortBy = NULL,
        ?bool $derefGroupMember = NULL,
        ?bool $includeMemberOf = NULL,
        ?bool $returnHiddenAttrs = NULL,
        ?bool $returnCertInfo = NULL,
        ?bool $wantImapUid = NULL,
        ?int $maxMembers = NULL,
        array $attributes = [],
        array $memberAttributes = [],
        array $contacts = []
    )
    {
        $this->setAttributes($attributes)
             ->setMemberAttributes($memberAttributes)
             ->setContacts($contacts);
        if (NULL !== $sync) {
            $this->setSync($sync);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $derefGroupMember) {
            $this->setDerefGroupMember($derefGroupMember);
        }
        if (NULL !== $includeMemberOf) {
            $this->setIncludeMemberOf($includeMemberOf);
        }
        if (NULL !== $returnHiddenAttrs) {
            $this->setReturnHiddenAttrs($returnHiddenAttrs);
        }
        if (NULL !== $returnCertInfo) {
            $this->setReturnCertInfo($returnCertInfo);
        }
        if (NULL !== $wantImapUid) {
            $this->setWantImapUid($wantImapUid);
        }
        if (NULL !== $maxMembers) {
            $this->setMaxMembers($maxMembers);
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
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Gets sortBy
     *
     * @return string
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * Sets sortBy
     *
     * @param  string $sortBy
     * @return self
     */
    public function setSortBy(string $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * Gets derefGroupMember
     *
     * @return bool
     */
    public function getDerefGroupMember(): ?bool
    {
        return $this->derefGroupMember;
    }

    /**
     * Sets derefGroupMember
     *
     * @param  bool $derefGroupMember
     * @return self
     */
    public function setDerefGroupMember(bool $derefGroupMember): self
    {
        $this->derefGroupMember = $derefGroupMember;
        return $this;
    }

    /**
     * Gets includeMemberOf
     *
     * @return bool
     */
    public function getIncludeMemberOf(): ?bool
    {
        return $this->includeMemberOf;
    }

    /**
     * Sets includeMemberOf
     *
     * @param  bool $includeMemberOf
     * @return self
     */
    public function setIncludeMemberOf(bool $includeMemberOf): self
    {
        $this->includeMemberOf = $includeMemberOf;
        return $this;
    }

    /**
     * Gets returnHiddenAttrs
     *
     * @return bool
     */
    public function getReturnHiddenAttrs(): ?bool
    {
        return $this->returnHiddenAttrs;
    }

    /**
     * Sets returnHiddenAttrs
     *
     * @param  bool $returnHiddenAttrs
     * @return self
     */
    public function setReturnHiddenAttrs(bool $returnHiddenAttrs): self
    {
        $this->returnHiddenAttrs = $returnHiddenAttrs;
        return $this;
    }

    /**
     * Gets returnCertInfo
     *
     * @return bool
     */
    public function getReturnCertInfo(): ?bool
    {
        return $this->returnCertInfo;
    }

    /**
     * Sets returnCertInfo
     *
     * @param  bool $returnCertInfo
     * @return self
     */
    public function setReturnCertInfo(bool $returnCertInfo): self
    {
        $this->returnCertInfo = $returnCertInfo;
        return $this;
    }

    /**
     * Gets wantImapUid
     *
     * @return bool
     */
    public function getWantImapUid(): ?bool
    {
        return $this->wantImapUid;
    }

    /**
     * Sets wantImapUid
     *
     * @param  bool $wantImapUid
     * @return self
     */
    public function setWantImapUid(bool $wantImapUid): self
    {
        $this->wantImapUid = $wantImapUid;
        return $this;
    }

    /**
     * Gets maxMembers
     *
     * @return int
     */
    public function getMaxMembers(): ?int
    {
        return $this->maxMembers;
    }

    /**
     * Sets maxMembers
     *
     * @param  int $maxMembers
     * @return self
     */
    public function setMaxMembers(int $maxMembers): self
    {
        $this->maxMembers = $maxMembers;
        return $this;
    }

    /**
     * Add attribute
     *
     * @param  AttributeName $attr
     * @return self
     */
    public function addAttribute(AttributeName $attr): self
    {
        $this->attributes[] = $attr;
        return $this;
    }

    /**
     * Sets attributes
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttributes(array $attrs): self
    {
        $this->attributes = array_filter($attrs, static fn ($attr) => $attr instanceof AttributeName);
        return $this;
    }

    /**
     * Gets attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Add member attribute
     *
     * @param  AttributeName $attr
     * @return self
     */
    public function addMemberAttribute(AttributeName $attr): self
    {
        $this->memberAttributes[] = $attr;
        return $this;
    }

    /**
     * Sets memberAttributes
     *
     * @param  array $attrs
     * @return self
     */
    public function setMemberAttributes(array $attrs): self
    {
        $this->memberAttributes = array_filter($attrs, static fn ($attr) => $attr instanceof AttributeName);
        return $this;
    }

    /**
     * Gets memberAttributes
     *
     * @return array
     */
    public function getMemberAttributes(): array
    {
        return $this->memberAttributes;
    }

    /**
     * Add contact
     *
     * @param  Id $contact
     * @return self
     */
    public function addContact(Id $contact): self
    {
        $this->contacts[] = $contact;
        return $this;
    }

    /**
     * Sets contacts
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = array_filter($contacts, static fn ($cn) => $cn instanceof Id);
        return $this;
    }

    /**
     * Gets contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetContactsEnvelope(
            new GetContactsBody($this)
        );
    }
}