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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Struct\{
    ContactAttr, ContactGroupMemberInterface, ContactInterface, CustomMetadataInterface, SearchHit
};

/**
 * ContactInfo struct class
 * Contact information
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactInfo implements ContactInterface, SearchHit
{
    /**
     * Sort field value
     * 
     * @var string
     */
    #[Accessor(getter: 'getSortField', setter: 'setSortField')]
    #[SerializedName(name: 'sf')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $sortField;

    /**
     * Set if the user can (has right to) expand group members.  Returned only if needExp
     * is set in the request and only on group entries (type=group in attrs on a <cn>).
     * 
     * @var bool
     */
    #[Accessor(getter: 'getCanExpand', setter: 'setCanExpand')]
    #[SerializedName(name: 'exp')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $canExpand;

    /**
     * Unique contact ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * IMAP UID
     * 
     * @var int
     */
    #[Accessor(getter: 'getImapUid', setter: 'setImapUid')]
    #[SerializedName(name: 'i4uid')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $imapUid;

    /**
     * Folder ID. When creating a contact, this is the ID of the folder to create the contact in
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolder', setter: 'setFolder')]
    #[SerializedName(name: 'l')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folder;

    /**
     * Flags.  {flags} = (f)lagged, has (a)ttachment
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName(name: 'f')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     * 
     * @var string
     */
    #[Accessor(getter: 'getTags', setter: 'setTags')]
    #[SerializedName(name: 't')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma-separated list of tag names
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName(name: 'tn')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * Modified date in seconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getChangeDate', setter: 'setChangeDate')]
    #[SerializedName(name: 'md')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $changeDate;

    /**
     * Modified sequence
     * 
     * @var int
     */
    #[Accessor(getter: 'getModifiedSequenceId', setter: 'setModifiedSequenceId')]
    #[SerializedName(name: 'ms')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $modifiedSequenceId;

    /**
     * Date in milliseconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getDate', setter: 'setDate')]
    #[SerializedName(name: 'd')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $date;

    /**
     * Saved sequence number
     * 
     * @var int
     */
    #[Accessor(getter: 'getRevisionId', setter: 'setRevisionId')]
    #[SerializedName(name: 'rev')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $revisionId;

    /**
     * Current "file as" string for display/sorting purposes; cannot be used to
     * set the file-as value
     * 
     * @var string
     */
    #[Accessor(getter: 'getFileAs', setter: 'setFileAs')]
    #[SerializedName(name: 'fileAsStr')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $fileAs;

    /**
     * Contact email address
     * 
     * @var string
     */
    #[Accessor(getter: 'getEmail', setter: 'setEmail')]
    #[SerializedName(name: 'email')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $email;

    /**
     * Contact email address 2
     * 
     * @var string
     */
    #[Accessor(getter: 'getEmail2', setter: 'setEmail2')]
    #[SerializedName(name: 'email2')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $email2;

    /**
     * Contact email address 3
     * 
     * @var string
     */
    #[Accessor(getter: 'getEmail3', setter: 'setEmail3')]
    #[SerializedName(name: 'email3')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $email3;

    /**
     * Contact type
     * 
     * @var string
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $type;

    /**
     * Contact dlist
     * 
     * @var string
     */
    #[Accessor(getter: 'getDlist', setter: 'setDlist')]
    #[SerializedName(name: 'dlist')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $dlist;

    /**
     * GAL entry reference
     * 
     * @var string
     */
    #[Accessor(getter: 'getReference', setter: 'setReference')]
    #[SerializedName(name: 'ref')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $reference;

    /**
     * If number of members on a GAL group is greater than the specified max,
     * do not return any members for the entry.  Instead, set "tooManyMembers.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getTooManyMembers', setter: 'setTooManyMembers')]
    #[SerializedName(name: 'tooManyMembers')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $tooManyMembers;

    /**
     * Custom metadata information
     * 
     * @var array
     */
    #[Accessor(getter: "getMetadatas", setter: "setMetadatas")]
    #[Type(name: 'array<Zimbra\Mail\Struct\MailCustomMetadata>')]
    #[XmlList(inline: true, entry: 'meta', namespace: 'urn:zimbraMail')]
    private $metadatas = [];

    /**
     * Attributes
     * 
     * @var array
     */
    #[Accessor(getter: "getAttrs", setter: "setAttrs")]
    #[Type(name: 'array<Zimbra\Common\Struct\ContactAttr>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraMail')]
    private $attrs = [];

    /**
     * Contact group members
     * 
     * @var array
     */
    #[Accessor(getter: "getContactGroupMembers", setter: "setContactGroupMembers")]
    #[Type(name: 'array<Zimbra\Mail\Struct\ContactGroupMember>')]
    #[XmlList(inline: true, entry: 'm', namespace: 'urn:zimbraMail')]
    private $contactGroupMembers = [];

    /**
     * Comma separated list of IDs of contact groups this contact is a member of. Only provided if requested
     * 
     * @var string
     */
    #[Accessor(getter: "getMemberOf", setter: "setMemberOf")]
    #[SerializedName(name: 'memberOf')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $memberOf;

    /**
     * Constructor
     *
     * @param string $id
     * @param string $sortField
     * @param bool $canExpand
     * @param string $folder
     * @param string $flags
     * @param string $tags
     * @param string $tagNames
     * @param int $changeDate
     * @param int $modifiedSequenceId
     * @param int $date
     * @param int $revisionId
     * @param string $fileAs
     * @param string $email
     * @param string $email2
     * @param string $email3
     * @param string $type
     * @param string $dlist
     * @param string $reference
     * @param bool $tooManyMembers
     * @param array $metadatas
     * @param array $attrs
     * @param array $contactGroupMembers
     * @param string $memberOf
     * @return self
     */
    public function __construct(
        string $id = '',
        ?string $sortField = NULL,
        ?bool $canExpand = NULL,
        ?int $imapUid = NULL,
        ?string $folder = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequenceId = NULL,
        ?int $date = NULL,
        ?int $revisionId = NULL,
        ?string $fileAs = NULL,
        ?string $email = NULL,
        ?string $email2 = NULL,
        ?string $email3 = NULL,
        ?string $type = NULL,
        ?string $dlist = NULL,
        ?string $reference = NULL,
        ?bool $tooManyMembers = NULL,
        array $metadatas  = [],
        array $attrs = [],
        array $contactGroupMembers = [],
        ?string $memberOf = NULL
    )
    {
        $this->setId($id)
             ->setMetadatas($metadatas)
             ->setAttrs($attrs)
             ->setContactGroupMembers($contactGroupMembers);

        if (NULL !== $sortField) {
            $this->setSortField($sortField);
        }
        if (NULL !== $canExpand) {
            $this->setCanExpand($canExpand);
        }
        if (NULL !== $imapUid) {
            $this->setImapUid($imapUid);
        }
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (NULL !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (NULL !== $modifiedSequenceId) {
            $this->setModifiedSequenceId($modifiedSequenceId);
        }
        if (NULL !== $date) {
            $this->setDate($date);
        }
        if (NULL !== $revisionId) {
            $this->setRevisionId($revisionId);
        }
        if (NULL !== $fileAs) {
            $this->setFileAs($fileAs);
        }
        if (NULL !== $email) {
            $this->setEmail($email);
        }
        if (NULL !== $email2) {
            $this->setEmail2($email2);
        }
        if (NULL !== $email3) {
            $this->setEmail3($email3);
        }
        if (NULL !== $type) {
            $this->setType($type);
        }
        if (NULL !== $dlist) {
            $this->setDlist($dlist);
        }
        if (NULL !== $reference) {
            $this->setReference($reference);
        }
        if (NULL !== $tooManyMembers) {
            $this->setTooManyMembers($tooManyMembers);
        }
        if (NULL !== $memberOf) {
            $this->setMemberOf($memberOf);
        }
    }

    /**
     * Get sort field value
     *
     * @return string
     */
    public function getSortField(): ?string
    {
        return $this->sortField;
    }

    /**
     * Set sort field value
     *
     * @param  string $sortField
     * @return self
     */
    public function setSortField(string $sortField): self
    {
        $this->sortField = $sortField;
        return $this;
    }

    /**
     * Get can expand
     *
     * @return bool
     */
    public function getCanExpand(): ?bool
    {
        return $this->canExpand;
    }

    /**
     * Set can expand
     *
     * @param  bool $canExpand
     * @return self
     */
    public function setCanExpand(bool $canExpand): self
    {
        $this->canExpand = $canExpand;
        return $this;
    }

    /**
     * Get Contact Id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set Contact Id
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
     * Get imapUid
     *
     * @return int
     */
    public function getImapUid(): ?int
    {
        return $this->imapUid;
    }

    /**
     * Set imapUid
     *
     * @param  int $imapUid
     * @return self
     */
    public function setImapUid(int $imapUid): self
    {
        $this->imapUid = $imapUid;
        return $this;
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Get flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Set flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags(string $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Set tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get tag names
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set tag names
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
        return $this;
    }

    /**
     * Get change date
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Set change date
     *
     * @param  int $changeDate
     * @return self
     */
    public function setChangeDate(int $changeDate): self
    {
        $this->changeDate = $changeDate;
        return $this;
    }

    /**
     * Get modified sequence ID
     *
     * @return int
     */
    public function getModifiedSequenceId(): ?int
    {
        return $this->modifiedSequenceId;
    }

    /**
     * Set modified sequence ID
     *
     * @param  int $modifiedSequenceId
     * @return self
     */
    public function setModifiedSequenceId(int $modifiedSequenceId): self
    {
        $this->modifiedSequenceId = $modifiedSequenceId;
        return $this;
    }

    /**
     * Get date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get revision ID
     *
     * @return int
     */
    public function getRevisionId(): ?int
    {
        return $this->revisionId;
    }

    /**
     * Set revision ID
     *
     * @param  int $revisionId
     * @return self
     */
    public function setRevisionId(int $revisionId): self
    {
        $this->revisionId = $revisionId;
        return $this;
    }

    /**
     * Get FileAs string for contact
     *
     * @return string
     */
    public function getFileAs(): ?string
    {
        return $this->fileAs;
    }

    /**
     * Set FileAs string for contact
     *
     * @param  string $fileAs
     * @return self
     */
    public function setFileAs(string $fileAs): self
    {
        $this->fileAs = $fileAs;
        return $this;
    }

    /**
     * Get contact email address
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set contact email address
     *
     * @param  string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get contact email address 2
     *
     * @return string
     */
    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    /**
     * Set contact email address 2
     *
     * @param  string $email2
     * @return self
     */
    public function setEmail2(string $email2): self
    {
        $this->email2 = $email2;
        return $this;
    }

    /**
     * Get contact email address 3
     *
     * @return string
     */
    public function getEmail3(): ?string
    {
        return $this->email3;
    }

    /**
     * Set contact email address 3
     *
     * @param  string $email3
     * @return self
     */
    public function setEmail3(string $email3): self
    {
        $this->email3 = $email3;
        return $this;
    }

    /**
     * Get contact type
     *
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set contact type
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get contact distribution list
     *
     * @return string
     */
    public function getDlist(): ?string
    {
        return $this->dlist;
    }

    /**
     * Set contact distribution list
     *
     * @param  string $dlist
     * @return self
     */
    public function setDlist(string $dlist): self
    {
        $this->dlist = $dlist;
        return $this;
    }

    /**
     * Get Global Address List entry reference
     *
     * @return string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * Set Global Address List entry reference
     *
     * @param  string $reference
     * @return self
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Get denotes whether the number of entries on a GAL group exceeds the specified max
     *
     * @return bool
     */
    public function getTooManyMembers(): ?bool
    {
        return $this->tooManyMembers;
    }

    /**
     * Set denotes whether the number of entries on a GAL group exceeds the specified max
     *
     * @param  bool $tooManyMembers
     * @return self
     */
    public function setTooManyMembers(bool $tooManyMembers): self
    {
        $this->tooManyMembers = $tooManyMembers;
        return $this;
    }

    /**
     * Get custom metadata information
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }

    /**
     * Set custom metadata information
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter($metadatas, static fn ($metadata) => $metadata instanceof CustomMetadataInterface);
        return $this;
    }

    /**
     * Get attributes
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Set attributes
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter($attrs, static fn ($attr) => $attr instanceof ContactAttr);
        return $this;
    }

    /**
     * Get contact group members
     *
     * @return array
     */
    public function getContactGroupMembers(): array
    {
        return $this->contactGroupMembers;
    }

    /**
     * Set contact group members
     *
     * @param  array $members
     * @return self
     */
    public function setContactGroupMembers(array $members): self
    {
        $this->contactGroupMembers = array_filter($members, static fn ($member) => $member instanceof ContactGroupMemberInterface);
        return $this;
    }

    /**
     * Get memberOf
     *
     * @return string
     */
    public function getMemberOf(): ?string
    {
        return $this->memberOf;
    }

    /**
     * Set memberOf
     *
     * @param  string $memberOf
     * @return self
     */
    public function setMemberOf(string $memberOf): self
    {
        $this->memberOf = $memberOf;
        return $this;
    }
}
