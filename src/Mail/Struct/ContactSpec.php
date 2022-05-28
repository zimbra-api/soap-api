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
use Zimbra\Common\Struct\SpecifyContact;

/**
 * ContactSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ContactSpec implements SpecifyContact
{
    /**
     * ID - specified when modifying a contact
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * ID of folder to create contact in. Un-specified means use the default Contacts folder.
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folder;

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
     * Either a vcard or attributes can be specified but not both.
     * @Accessor(getter="getVcard", setter="setVcard")
     * @SerializedName("vcard")
     * @Type("Zimbra\Mail\Struct\VCardInfo")
     * @XmlElement
     */
    private ?VCardInfo $vcard = NULL;

    /**
     * Contact attributes.  Cannot specify <vcard> as well as these
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Mail\Struct\NewContactAttr>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attrs = [];

    /**
     * Valid only if the contact being created is a contact group
     * (has attribute type="group")
     * @Accessor(getter="getContactGroupMembers", setter="setContactGroupMembers")
     * @SerializedName("m")
     * @Type("array<Zimbra\Mail\Struct\NewContactGroupMember>")
     * @XmlList(inline = true, entry = "m")
     */
    private $contactGroupMembers = [];

    /**
     * Constructor method for ContactSpec
     *
     * @param int $id
     * @param string $folder
     * @param string $tags
     * @param string $tagNames
     * @param VCardInfo $vcard
     * @param array $attrs
     * @param array $contactGroupMembers
     * @return self
     */
    public function __construct(
        ?int $id = NULL,
        ?string $folder = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?VCardInfo $vcard = NULL,
        array $attrs = [],
        array $contactGroupMembers = []
    )
    {
        $this->setAttrs($attrs)
             ->setContactGroupMembers($contactGroupMembers);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if ($vcard instanceof VCardInfo) {
            $this->setVcard($vcard);
        }
    }

    /**
     * Gets Contact Id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets Contact Id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
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
     * Gets vcard
     *
     * @return VCardInfo
     */
    public function getVcard(): ?VCardInfo
    {
        return $this->vcard;
    }

    /**
     * Sets vcard
     *
     * @param  VCardInfo $vcard
     * @return self
     */
    public function setVcard(VCardInfo $vcard): self
    {
        $this->vcard = $vcard;
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
        $this->attrs = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof NewContactAttr) {
                $this->attrs[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Add an contact attribute
     *
     * @param  NewContactAttr $attr
     * @return self
     */
    public function addAttr(NewContactAttr $attr): self
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
        $this->contactGroupMembers = [];
        foreach ($contactGroupMembers as $contactGroupMember) {
            if ($contactGroupMember instanceof NewContactGroupMember) {
                $this->contactGroupMembers[] = $contactGroupMember;
            }
        }
        return $this;
    }

    /**
     * Add contact group member
     *
     * @param  NewContactGroupMember $contactGroupMember
     * @return self
     */
    public function addContactGroupMember(NewContactGroupMember $contactGroupMember): self
    {
        $this->contactGroupMembers[] = $contactGroupMember;
        return $this;
    }
}
