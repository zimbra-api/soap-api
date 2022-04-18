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
use Zimbra\Struct\{
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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ContactInfo implements ContactInterface, SearchHit
{
    /**
     * Sort field value
     * @Accessor(getter="getSortField", setter="setSortField")
     * @SerializedName("sf")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortField;

    /**
     * Set if the user can (has right to) expand group members.  Returned only if needExp
     * is set in the request and only on group entries (type=group in attrs on a <cn>).
     * @Accessor(getter="getCanExpand", setter="setCanExpand")
     * @SerializedName("exp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $canExpand;

    /**
     * Unique contact ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * IMAP UID
     * @Accessor(getter="getImapUid", setter="setImapUid")
     * @SerializedName("i4uid")
     * @Type("integer")
     * @XmlAttribute
     */
    private $imapUid;

    /**
     * Folder ID.  When creating a contact, this is the ID of the folder to create the contact in
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folder;

    /**
     * Flags.  {flags} = (f)lagged, has (a)ttachment
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * Tags - Comma separated list of integers.  DEPRECATED - use "tn" instead
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $tags;

    /**
     * Comma-separated list of tag names
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $tagNames;

    /**
     * Modified date in seconds
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("int")
     * @XmlAttribute
     */
    private $changeDate;

    /**
     * Modified sequence
     * @Accessor(getter="getModifiedSequenceId", setter="setModifiedSequenceId")
     * @SerializedName("ms")
     * @Type("int")
     * @XmlAttribute
     */
    private $modifiedSequenceId;

    /**
     * Date in milliseconds
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("int")
     * @XmlAttribute
     */
    private $date;

    /**
     * Saved sequence number
     * @Accessor(getter="getRevisionId", setter="setRevisionId")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     */
    private $revisionId;

    /**
     * Current "file as" string for display/sorting purposes; cannot be used to
     * set the file-as value
     * @Accessor(getter="getFileAs", setter="setFileAs")
     * @SerializedName("fileAsStr")
     * @Type("string")
     * @XmlAttribute
     */
    private $fileAs;

    /**
     * Contact email address
     * @Accessor(getter="getEmail", setter="setEmail")
     * @SerializedName("email")
     * @Type("string")
     * @XmlAttribute
     */
    private $email;

    /**
     * Contact email address 2
     * @Accessor(getter="getEmail2", setter="setEmail2")
     * @SerializedName("email2")
     * @Type("string")
     * @XmlAttribute
     */
    private $email2;

    /**
     * Contact email address 3
     * @Accessor(getter="getEmail3", setter="setEmail3")
     * @SerializedName("email3")
     * @Type("string")
     * @XmlAttribute
     */
    private $email3;

    /**
     * Contact type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * Contact dlist
     * @Accessor(getter="getDlist", setter="setDlist")
     * @SerializedName("dlist")
     * @Type("string")
     * @XmlAttribute
     */
    private $dlist;

    /**
     * GAL entry reference
     * @Accessor(getter="getReference", setter="setReference")
     * @SerializedName("ref")
     * @Type("string")
     * @XmlAttribute
     */
    private $reference;

    /**
     * If number of members on a GAL group is greater than the specified max,
     * do not return any members for the entry.  Instead, set "tooManyMembers.
     * @Accessor(getter="getTooManyMembers", setter="setTooManyMembers")
     * @SerializedName("tooManyMembers")
     * @Type("bool")
     * @XmlAttribute
     */
    private $tooManyMembers;

    /**
     * Custom metadata information
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @SerializedName("meta")
     * @Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")
     * @XmlList(inline = true, entry = "meta")
     */
    private $metadatas = [];

    /**
     * Attributes
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Struct\ContactAttr>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attrs = [];

    /**
     * Contact group members
     * @Accessor(getter="getContactGroupMembers", setter="setContactGroupMembers")
     * @SerializedName("m")
     * @Type("array<Zimbra\Mail\Struct\ContactGroupMember>")
     * @XmlList(inline = true, entry = "m")
     */
    private $contactGroupMembers = [];

    /**
     * Comma separated list of IDs of contact groups this contact is a member of. Only provided if requested
     * @Accessor(getter="getMemberOf", setter="setMemberOf")
     * @SerializedName("memberOf")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $memberOf;

    /**
     * Constructor method for ContactInfo
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
        string $id,
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
     * Gets sort field value
     *
     * @return string
     */
    public function getSortField(): ?string
    {
        return $this->sortField;
    }

    /**
     * Sets sort field value
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
     * Gets can expand
     *
     * @return bool
     */
    public function getCanExpand(): ?bool
    {
        return $this->canExpand;
    }

    /**
     * Sets can expand
     *
     * @param  string $canExpand
     * @return bool
     */
    public function setCanExpand(bool $canExpand): self
    {
        $this->canExpand = $canExpand;
        return $this;
    }

    /**
     * Gets Contact Id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets Contact Id
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
     * Gets imapUid
     *
     * @return int
     */
    public function getImapUid(): ?int
    {
        return $this->imapUid;
    }

    /**
     * Sets imapUid
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
     * Gets folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Sets folder
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
     * Gets flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Sets flags
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
     * Gets tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Sets tags
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
     * Gets tag names
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Sets tag names
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
     * Gets change date
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Sets change date
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
     * Gets modified sequence ID
     *
     * @return int
     */
    public function getModifiedSequenceId(): ?int
    {
        return $this->modifiedSequenceId;
    }

    /**
     * Sets modified sequence ID
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
     * Gets date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Sets date
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
     * Gets revision ID
     *
     * @return int
     */
    public function getRevisionId(): ?int
    {
        return $this->revisionId;
    }

    /**
     * Sets revision ID
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
     * Gets FileAs string for contact
     *
     * @return string
     */
    public function getFileAs(): ?string
    {
        return $this->fileAs;
    }

    /**
     * Sets FileAs string for contact
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
     * Gets contact email address
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Sets contact email address
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
     * Gets contact email address 2
     *
     * @return string
     */
    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    /**
     * Sets contact email address 2
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
     * Gets contact email address 3
     *
     * @return string
     */
    public function getEmail3(): ?string
    {
        return $this->email3;
    }

    /**
     * Sets contact email address 3
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
     * Gets contact type
     *
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Sets contact type
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
     * Gets contact distribution list
     *
     * @return string
     */
    public function getDlist(): ?string
    {
        return $this->dlist;
    }

    /**
     * Sets contact distribution list
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
     * Gets Global Address List entry reference
     *
     * @return string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * Sets Global Address List entry reference
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
     * Gets denotes whether the number of entries on a GAL group exceeds the specified max
     *
     * @return bool
     */
    public function getTooManyMembers(): ?bool
    {
        return $this->tooManyMembers;
    }

    /**
     * Sets denotes whether the number of entries on a GAL group exceeds the specified max
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
     * Gets custom metadata information
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }

    /**
     * Sets custom metadata information
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        if (!empty($metadatas)) {
            $this->metadatas = [];
            foreach ($metadatas as $metadata) {
                if ($metadata instanceof CustomMetadataInterface) {
                    $this->metadatas[] = $metadata;
                }
            }
        }
        return $this;
    }

    /**
     * Add custom metadata information
     *
     * @param  CustomMetadataInterface $metadata
     * @return self
     */
    public function addMetadata(CustomMetadataInterface $metadata): self
    {
        $this->metadatas[] = $metadata;
        return $this;
    }

    /**
     * Gets attributes
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Sets attributes
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        if (!empty($attrs)) {
            $this->attrs = [];
            foreach ($attrs as $attr) {
                if ($attr instanceof ContactAttr) {
                    $this->attrs[] = $attr;
                }
            }
        }
        return $this;
    }

    /**
     * Add an contact attribute
     *
     * @param  ContactAttr $attr
     * @return self
     */
    public function addAttr(ContactAttr $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Gets contact group members
     *
     * @return array
     */
    public function getContactGroupMembers(): array
    {
        return $this->contactGroupMembers;
    }

    /**
     * Sets contact group members
     *
     * @param  array $attrs
     * @return self
     */
    public function setContactGroupMembers(array $contactGroupMembers): self
    {
        if (!empty($contactGroupMembers)) {
            $this->contactGroupMembers = [];
            foreach ($contactGroupMembers as $contactGroupMember) {
                if ($contactGroupMember instanceof ContactGroupMemberInterface) {
                    $this->contactGroupMembers[] = $contactGroupMember;
                }
            }
        }
        return $this;
    }

    /**
     * Add contact group member
     *
     * @param  ContactGroupMemberInterface $contactGroupMember
     * @return self
     */
    public function addContactGroupMember(ContactGroupMemberInterface $contactGroupMember): self
    {
        $this->contactGroupMembers[] = $contactGroupMember;
        return $this;
    }

    /**
     * Gets memberOf
     *
     * @return string
     */
    public function getMemberOf(): ?string
    {
        return $this->memberOf;
    }

    /**
     * Sets memberOf
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
