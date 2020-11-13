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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Struct\ContactAttr;

/**
 * ContactInfo struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="cn")
 */
class ContactInfo
{
    /**
     * @Accessor(getter="getSortField", setter="setSortField")
     * @SerializedName("sf")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortField;

    /**
     * @Accessor(getter="getCanExpand", setter="setCanExpand")
     * @SerializedName("exp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $canExpand;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folder;

    /**
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $tags;

    /**
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $tagNames;

    /**
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("int")
     * @XmlAttribute
     */
    private $changeDate;

    /**
     * @Accessor(getter="getModifiedSequenceId", setter="setModifiedSequenceId")
     * @SerializedName("ms")
     * @Type("int")
     * @XmlAttribute
     */
    private $modifiedSequenceId;

    /**
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("int")
     * @XmlAttribute
     */
    private $date;

    /**
     * @Accessor(getter="getRevisionId", setter="setRevisionId")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     */
    private $revisionId;

    /**
     * @Accessor(getter="getFileAs", setter="setFileAs")
     * @SerializedName("fileAsStr")
     * @Type("string")
     * @XmlAttribute
     */
    private $fileAs;

    /**
     * @Accessor(getter="getEmail", setter="setEmail")
     * @SerializedName("email")
     * @Type("string")
     * @XmlAttribute
     */
    private $email;

    /**
     * @Accessor(getter="getEmail2", setter="setEmail2")
     * @SerializedName("email2")
     * @Type("string")
     * @XmlAttribute
     */
    private $email2;

    /**
     * @Accessor(getter="getEmail3", setter="setEmail3")
     * @SerializedName("email3")
     * @Type("string")
     * @XmlAttribute
     */
    private $email3;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * @Accessor(getter="getDlist", setter="setDlist")
     * @SerializedName("dlist")
     * @Type("string")
     * @XmlAttribute
     */
    private $dlist;

    /**
     * @Accessor(getter="getReference", setter="setReference")
     * @SerializedName("ref")
     * @Type("string")
     * @XmlAttribute
     */
    private $reference;

    /**
     * @Accessor(getter="getTooManyMembers", setter="setTooManyMembers")
     * @SerializedName("tooManyMembers")
     * @Type("bool")
     * @XmlAttribute
     */
    private $tooManyMembers;

    /**
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @SerializedName("meta")
     * @Type("array<Zimbra\Account\Struct\AccountCustomMetadata>")
     * @XmlList(inline = true, entry = "meta")
     */
    private $metadatas;

    /**
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Struct\ContactAttr>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attrs;

    /**
     * @Accessor(getter="getContactGroupMembers", setter="setContactGroupMembers")
     * @SerializedName("m")
     * @Type("array<Zimbra\Account\Struct\ContactGroupMember>")
     * @XmlList(inline = true, entry = "m")
     */
    private $contactGroupMembers;

    /**
     * @Accessor(getter="isOwner", setter="setIsOwner")
     * @SerializedName("isOwner")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isOwner;

    /**
     * @Accessor(getter="isMember", setter="setIsMember")
     * @SerializedName("isMember")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isMember;

    /**
     * Constructor method for ContactGroupMember
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
        $sortField = NULL,
        $canExpand = NULL,
        $id = NULL,
        $folder = NULL,
        $flags = NULL,
        $tags = NULL,
        $tagNames = NULL,
        $changeDate = NULL,
        $modifiedSequenceId = NULL,
        $date = NULL,
        $revisionId = NULL,
        $fileAs = NULL,
        $email = NULL,
        $email2 = NULL,
        $email3 = NULL,
        $type = NULL,
        $dlist = NULL,
        $reference = NULL,
        $tooManyMembers = NULL,
        array $metadatas = NULL,
        array $attrs = NULL,
        array $contactGroupMembers = NULL,
        $isOwner = NULL,
        $isMember = NULL
    )
    {
        if (NULL !== $sortField) {
            $this->setSortField($sortField);
        }
        if (NULL !== $canExpand) {
            $this->setCanExpand($canExpand);
        }
        if (NULL !== $id) {
            $this->setId($id);
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
        if (NULL !== $metadatas) {
            $this->setMetadatas($metadatas);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
        if (NULL !== $contactGroupMembers) {
            $this->setContactGroupMembers($contactGroupMembers);
        }
        if (NULL !== $isOwner) {
            $this->setIsOwner($isOwner);
        }
        if (NULL !== $isMember) {
            $this->setIsMember($isMember);
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
    public function setSortField($sortField): self
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
    public function setCanExpand($canExpand): self
    {
        $this->canExpand = (bool) $canExpand;
        return $this;
    }

    /**
     * Gets Contact Id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets Contact Id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
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
    public function setFolder($folder): self
    {
        $this->folder = trim($folder);
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
    public function setFlags($flags): self
    {
        $this->flags = trim($flags);
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
    public function setTags($tags): self
    {
        $this->tags = trim($tags);
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
    public function setTagNames($tagNames): self
    {
        $this->tagNames = trim($tagNames);
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
    public function setChangeDate($changeDate): self
    {
        $this->changeDate = (int) $changeDate;
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
    public function setModifiedSequenceId($modifiedSequenceId): self
    {
        $this->modifiedSequenceId = (int) $modifiedSequenceId;
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
    public function setDate($date): self
    {
        $this->date = (int) $date;
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
    public function setRevisionId($revisionId): self
    {
        $this->revisionId = (int) $revisionId;
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
    public function setFileAs($fileAs): self
    {
        $this->fileAs = trim($fileAs);
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
    public function setEmail($email): self
    {
        $this->email = trim($email);
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
    public function setEmail2($email2): self
    {
        $this->email2 = trim($email2);
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
    public function setEmail3($email3): self
    {
        $this->email3 = trim($email3);
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
    public function setType($type): self
    {
        $this->type = trim($type);
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
    public function setDlist($dlist): self
    {
        $this->dlist = trim($dlist);
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
    public function setReference($reference): self
    {
        $this->reference = trim($reference);
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
    public function setTooManyMembers($tooManyMembers): self
    {
        $this->tooManyMembers = (bool) $tooManyMembers;
        return $this;
    }

    /**
     * Gets custom metadata information
     *
     * @return array
     */
    public function getMetadatas(): ?array
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
                if ($metadata instanceof AccountCustomMetadata) {
                    $this->metadatas[] = $metadata;
                }
            }
        }
        return $this;
    }

    /**
     * Add custom metadata information
     *
     * @param  AccountCustomMetadata $metadata
     * @return self
     */
    public function addMetadata(AccountCustomMetadata $metadata): self
    {
        $this->metadatas[] = $metadata;
        return $this;
    }

    /**
     * Gets attributes
     *
     * @return array
     */
    public function getAttrs(): ?array
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
    public function getContactGroupMembers(): ?array
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
                if ($contactGroupMember instanceof ContactGroupMember) {
                    $this->contactGroupMembers[] = $contactGroupMember;
                }
            }
        }
        return $this;
    }

    /**
     * Add contact group member
     *
     * @param  ContactGroupMember $contactGroupMember
     * @return self
     */
    public function addContactGroupMember(ContactGroupMember $contactGroupMember): self
    {
        $this->contactGroupMembers[] = $contactGroupMember;
        return $this;
    }

    /**
     * Gets flags whether user is the owner of a group
     *
     * @return bool
     */
    public function isOwner(): ?bool
    {
        return $this->isOwner;
    }

    /**
     * Sets flags whether user is the owner of a group
     *
     * @param  bool $isOwner
     * @return self
     */
    public function setIsOwner($isOwner): self
    {
        $this->isOwner = (bool) $isOwner;
        return $this;
    }

    /**
     * Gets flags whether user is a member of a group
     *
     * @return bool
     */
    public function isMember(): ?bool
    {
        return $this->isMember;
    }

    /**
     * Sets flags whether user is a member of a group
     *
     * @param  bool $isMember
     * @return self
     */
    public function setIsMember($isMember): self
    {
        $this->isMember = (bool) $isMember;
        return $this;
    }
}
