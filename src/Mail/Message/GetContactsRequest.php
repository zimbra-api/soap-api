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
use Zimbra\Common\Struct\{AttributeName, Id, SoapEnvelopeInterface, SoapRequest};

/**
 * GetContactsRequest class
 * Get contacts
 * Contact group members are returned as <m> elements.
 * If derefGroupMember is not set, group members are returned in the order they were inserted in the group.
 * If derefGroupMember is set, group members are returned ordered by the "key" of member.
 * Key is:
 * - for contact ref (type="C"): the fileAs field of the Contact
 * - for GAL ref (type="G"): email address of the GAL entry
 * - for inlined member (type="I"): the value
 * 
 * Contact group members are returned as sub-elements of <m>.
 * If for any(transient or permanent) reason a member cannot be dereferenced,
 * then there will be no sub-element under <m>.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetContactsRequest extends SoapRequest
{
    /**
     * If set, return modified date (md) on contacts.
     * 
     * @Accessor(getter="getSync", setter="setSync")
     * @SerializedName("sync")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getSync', setter: 'setSync')]
    #[SerializedName('sync')]
    #[Type('bool')]
    #[XmlAttribute]
    private $sync;

    /**
     * If is present, return only contacts in the specified folder.
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName('l')]
    #[Type('string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * Sort by
     * 
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getSortBy', setter: 'setSortBy')]
    #[SerializedName('sortBy')]
    #[Type('string')]
    #[XmlAttribute]
    private $sortBy;

    /**
     * If set, deref contact group members.
     * 
     * @Accessor(getter="getDerefGroupMember", setter="setDerefGroupMember")
     * @SerializedName("derefGroupMember")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getDerefGroupMember', setter: 'setDerefGroupMember')]
    #[SerializedName('derefGroupMember')]
    #[Type('bool')]
    #[XmlAttribute]
    private $derefGroupMember;

    /**
     * If set, Include the list of contact groups this contact is a member of.
     * 
     * @Accessor(getter="getIncludeMemberOf", setter="setIncludeMemberOf")
     * @SerializedName("memberOf")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getIncludeMemberOf', setter: 'setIncludeMemberOf')]
    #[SerializedName('memberOf')]
    #[Type('bool')]
    #[XmlAttribute]
    private $includeMemberOf;

    /**
     * Whether to return contact hidden attrs defined in zimbraContactHiddenAttributes
     * 
     * @Accessor(getter="getReturnHiddenAttrs", setter="setReturnHiddenAttrs")
     * @SerializedName("returnHiddenAttrs")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getReturnHiddenAttrs', setter: 'setReturnHiddenAttrs')]
    #[SerializedName('returnHiddenAttrs')]
    #[Type('bool')]
    #[XmlAttribute]
    private $returnHiddenAttrs;

    /**
     * Whether to return smime certificate info
     * 
     * @Accessor(getter="getReturnCertInfo", setter="setReturnCertInfo")
     * @SerializedName("returnCertInfo")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getReturnCertInfo', setter: 'setReturnCertInfo')]
    #[SerializedName('returnCertInfo')]
    #[Type('bool')]
    #[XmlAttribute]
    private $returnCertInfo;

    /**
     * Set to return IMAP UID.  (default is unset.)
     * 
     * @Accessor(getter="getWantImapUid", setter="setWantImapUid")
     * @SerializedName("wantImapUid")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getWantImapUid', setter: 'setWantImapUid')]
    #[SerializedName('wantImapUid')]
    #[Type('bool')]
    #[XmlAttribute]
    private $wantImapUid;

    /**
     * Max members
     * 
     * @Accessor(getter="getMaxMembers", setter="setMaxMembers")
     * @SerializedName("maxMembers")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getMaxMembers', setter: 'setMaxMembers')]
    #[SerializedName('maxMembers')]
    #[Type('int')]
    #[XmlAttribute]
    private $maxMembers;

    /**
     * Attrs - if present, return only the specified attribute(s).
     * 
     * @Accessor(getter="getAttributes", setter="setAttributes")
     * @Type("array<Zimbra\Common\Struct\AttributeName>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttributes', setter: 'setAttributes')]
    #[Type('array<Zimbra\Common\Struct\AttributeName>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraMail')]
    private $attributes = [];

    /**
     * If present, return only the specified attribute(s) for derefed members, applicable
     * only when derefGroupMember is set.
     * 
     * @Accessor(getter="getMemberAttributes", setter="setMemberAttributes")
     * @Type("array<Zimbra\Common\Struct\AttributeName>")
     * @XmlList(inline=true, entry="ma", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getMemberAttributes', setter: 'setMemberAttributes')]
    #[Type('array<Zimbra\Common\Struct\AttributeName>')]
    #[XmlList(inline: true, entry: 'ma', namespace: 'urn:zimbraMail')]
    private $memberAttributes = [];

    /**
     * If present, only get the specified contact(s).
     * 
     * @Accessor(getter="getContacts", setter="setContacts")
     * @Type("array<Zimbra\Common\Struct\Id>")
     * @XmlList(inline=true, entry="cn", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getContacts', setter: 'setContacts')]
    #[Type('array<Zimbra\Common\Struct\Id>')]
    #[XmlList(inline: true, entry: 'cn', namespace: 'urn:zimbraMail')]
    private $contacts = [];

    /**
     * Constructor
     *
     * @param  bool $sync
     * @param  string $folderId
     * @param  string $sortBy
     * @param  bool $derefGroupMember
     * @param  bool $includeMemberOf
     * @param  bool $returnHiddenAttrs
     * @param  bool $returnCertInfo
     * @param  bool $wantImapUid
     * @param  int $maxMembers
     * @param  array $attributes
     * @param  array $memberAttributes
     * @param  array $contacts
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
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
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
     * Get sortBy
     *
     * @return string
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * Set sortBy
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
     * Get derefGroupMember
     *
     * @return bool
     */
    public function getDerefGroupMember(): ?bool
    {
        return $this->derefGroupMember;
    }

    /**
     * Set derefGroupMember
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
     * Get includeMemberOf
     *
     * @return bool
     */
    public function getIncludeMemberOf(): ?bool
    {
        return $this->includeMemberOf;
    }

    /**
     * Set includeMemberOf
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
     * Get returnHiddenAttrs
     *
     * @return bool
     */
    public function getReturnHiddenAttrs(): ?bool
    {
        return $this->returnHiddenAttrs;
    }

    /**
     * Set returnHiddenAttrs
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
     * Get returnCertInfo
     *
     * @return bool
     */
    public function getReturnCertInfo(): ?bool
    {
        return $this->returnCertInfo;
    }

    /**
     * Set returnCertInfo
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
     * Get wantImapUid
     *
     * @return bool
     */
    public function getWantImapUid(): ?bool
    {
        return $this->wantImapUid;
    }

    /**
     * Set wantImapUid
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
     * Get maxMembers
     *
     * @return int
     */
    public function getMaxMembers(): ?int
    {
        return $this->maxMembers;
    }

    /**
     * Set maxMembers
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
     * Set attributes
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
     * Get attributes
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
     * Set memberAttributes
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
     * Get memberAttributes
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
     * Set contacts
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
     * Get contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetContactsEnvelope(
            new GetContactsBody($this)
        );
    }
}
