<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};
use Zimbra\Common\Struct\ContactAttr;

/**
 * ContactInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactInfo
{
    /**
     * Sort field
     *
     * @var string
     */
    #[Accessor(getter: "getSortField", setter: "setSortField")]
    #[SerializedName("sf")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $sortField = null;

    /**
     * Can expand
     *
     * @var bool
     */
    #[Accessor(getter: "getCanExpand", setter: "setCanExpand")]
    #[SerializedName("exp")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $canExpand = null;

    /**
     * Id
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $id = null;

    /**
     * Folder
     *
     * @var string
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folder = null;

    /**
     * Flags
     *
     * @var string
     */
    #[Accessor(getter: "getFlags", setter: "setFlags")]
    #[SerializedName("f")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $flags = null;

    /**
     * Tags
     *
     * @var string
     */
    #[Accessor(getter: "getTags", setter: "setTags")]
    #[SerializedName("t")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $tags = null;

    /**
     * Tag names
     *
     * @var string
     */
    #[Accessor(getter: "getTagNames", setter: "setTagNames")]
    #[SerializedName("tn")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $tagNames = null;

    /**
     * Change date
     *
     * @var int
     */
    #[Accessor(getter: "getChangeDate", setter: "setChangeDate")]
    #[SerializedName("md")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $changeDate = null;

    /**
     * Modified sequence id
     *
     * @var int
     */
    #[
        Accessor(
            getter: "getModifiedSequenceId",
            setter: "setModifiedSequenceId"
        )
    ]
    #[SerializedName("ms")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $modifiedSequenceId = null;

    /**
     * Date
     *
     * @var int
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $date = null;

    /**
     * Revision id
     *
     * @var int
     */
    #[Accessor(getter: "getRevisionId", setter: "setRevisionId")]
    #[SerializedName("rev")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $revisionId = null;

    /**
     * File as
     *
     * @var string
     */
    #[Accessor(getter: "getFileAs", setter: "setFileAs")]
    #[SerializedName("fileAsStr")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $fileAs = null;

    /**
     * Email
     *
     * @var string
     */
    #[Accessor(getter: "getEmail", setter: "setEmail")]
    #[SerializedName("email")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $email = null;

    /**
     * Email2
     *
     * @var string
     */
    #[Accessor(getter: "getEmail2", setter: "setEmail2")]
    #[SerializedName("email2")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $email2 = null;

    /**
     * Email3
     *
     * @var string
     */
    #[Accessor(getter: "getEmail3", setter: "setEmail3")]
    #[SerializedName("email3")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $email3 = null;

    /**
     * Type
     *
     * @var string
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $type = null;

    /**
     * Dlist
     *
     * @var string
     */
    #[Accessor(getter: "getDlist", setter: "setDlist")]
    #[SerializedName("dlist")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $dlist = null;

    /**
     * Reference
     *
     * @var string
     */
    #[Accessor(getter: "getReference", setter: "setReference")]
    #[SerializedName("ref")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $reference = null;

    /**
     * Too many members
     *
     * @var bool
     */
    #[Accessor(getter: "getTooManyMembers", setter: "setTooManyMembers")]
    #[SerializedName("tooManyMembers")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $tooManyMembers = null;

    /**
     * Metadatas
     *
     * @var array
     */
    #[Accessor(getter: "getMetadatas", setter: "setMetadatas")]
    #[Type("array<Zimbra\Account\Struct\AccountCustomMetadata>")]
    #[XmlList(inline: true, entry: "meta", namespace: "urn:zimbraAccount")]
    private array $metadatas = [];

    /**
     * Attributes
     *
     * @var array
     */
    #[Accessor(getter: "getAttrs", setter: "setAttrs")]
    #[Type("array<Zimbra\Common\Struct\ContactAttr>")]
    #[XmlList(inline: true, entry: "a", namespace: "urn:zimbraAccount")]
    private array $attrs = [];

    /**
     * Contact group members
     *
     * @var array
     */
    #[
        Accessor(
            getter: "getContactGroupMembers",
            setter: "setContactGroupMembers"
        )
    ]
    #[Type("array<Zimbra\Account\Struct\ContactGroupMember>")]
    #[XmlList(inline: true, entry: "m", namespace: "urn:zimbraAccount")]
    private array $contactGroupMembers = [];

    /**
     * is owner
     *
     * @var bool
     */
    #[Accessor(getter: "isOwner", setter: "setIsOwner")]
    #[SerializedName("isOwner")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isOwner = null;

    /**
     * is member
     *
     * @var bool
     */
    #[Accessor(getter: "isMember", setter: "setIsMember")]
    #[SerializedName("isMember")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $isMember = null;

    /**
     * Constructor
     *
     * @param string $sortField
     * @param bool $canExpand
     * @param string $id
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
     * @param bool $isOwner
     * @param bool $isMember
     * @return self
     */
    public function __construct(
        ?string $sortField = null,
        ?bool $canExpand = null,
        ?string $id = null,
        ?string $folder = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?int $changeDate = null,
        ?int $modifiedSequenceId = null,
        ?int $date = null,
        ?int $revisionId = null,
        ?string $fileAs = null,
        ?string $email = null,
        ?string $email2 = null,
        ?string $email3 = null,
        ?string $type = null,
        ?string $dlist = null,
        ?string $reference = null,
        ?bool $tooManyMembers = null,
        array $metadatas = null,
        array $attrs = null,
        array $contactGroupMembers = null,
        ?bool $isOwner = null,
        ?bool $isMember = null
    ) {
        if (null !== $sortField) {
            $this->setSortField($sortField);
        }
        if (null !== $canExpand) {
            $this->setCanExpand($canExpand);
        }
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $folder) {
            $this->setFolder($folder);
        }
        if (null !== $flags) {
            $this->setFlags($flags);
        }
        if (null !== $tags) {
            $this->setTags($tags);
        }
        if (null !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (null !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (null !== $modifiedSequenceId) {
            $this->setModifiedSequenceId($modifiedSequenceId);
        }
        if (null !== $date) {
            $this->setDate($date);
        }
        if (null !== $revisionId) {
            $this->setRevisionId($revisionId);
        }
        if (null !== $fileAs) {
            $this->setFileAs($fileAs);
        }
        if (null !== $email) {
            $this->setEmail($email);
        }
        if (null !== $email2) {
            $this->setEmail2($email2);
        }
        if (null !== $email3) {
            $this->setEmail3($email3);
        }
        if (null !== $type) {
            $this->setType($type);
        }
        if (null !== $dlist) {
            $this->setDlist($dlist);
        }
        if (null !== $reference) {
            $this->setReference($reference);
        }
        if (null !== $tooManyMembers) {
            $this->setTooManyMembers($tooManyMembers);
        }
        if (null !== $metadatas) {
            $this->setMetadatas($metadatas);
        }
        if (null !== $attrs) {
            $this->setAttrs($attrs);
        }
        if (null !== $contactGroupMembers) {
            $this->setContactGroupMembers($contactGroupMembers);
        }
        if (null !== $isOwner) {
            $this->setIsOwner($isOwner);
        }
        if (null !== $isMember) {
            $this->setIsMember($isMember);
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
    public function getId(): ?string
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
    public function getMetadatas(): ?array
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
        $this->metadatas = array_filter(
            $metadatas,
            static fn($metadata) => $metadata instanceof AccountCustomMetadata
        );
        return $this;
    }

    /**
     * Get attributes
     *
     * @return array
     */
    public function getAttrs(): ?array
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
        $this->attrs = array_filter(
            $attrs,
            static fn($attr) => $attr instanceof ContactAttr
        );
        return $this;
    }

    /**
     * Get contact group members
     *
     * @return array
     */
    public function getContactGroupMembers(): ?array
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
        $this->contactGroupMembers = array_filter(
            $members,
            static fn($member) => $member instanceof ContactGroupMember
        );
        return $this;
    }

    /**
     * Get flags whether user is the owner of a group
     *
     * @return bool
     */
    public function isOwner(): ?bool
    {
        return $this->isOwner;
    }

    /**
     * Set flags whether user is the owner of a group
     *
     * @param  bool $isOwner
     * @return self
     */
    public function setIsOwner(bool $isOwner): self
    {
        $this->isOwner = $isOwner;
        return $this;
    }

    /**
     * Get flags whether user is a member of a group
     *
     * @return bool
     */
    public function isMember(): ?bool
    {
        return $this->isMember;
    }

    /**
     * Set flags whether user is a member of a group
     *
     * @param  bool $isMember
     * @return self
     */
    public function setIsMember(bool $isMember): self
    {
        $this->isMember = $isMember;
        return $this;
    }
}
