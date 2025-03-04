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

/**
 * ActionSelector class
 * Action selector
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ActionSelector
{
    /**
     * Comma separated list of item IDs to act on.  Required except for TagActionRequest,
     * where the tags items can be specified using their tag names as an alternative.
     *
     * @var string
     */
    #[Accessor(getter: "getIds", setter: "setIds")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $ids = null;

    /**
     * The operation to perform
     * For ItemAction    - delete|dumpsterdelete|recover|read|flag|priority|tag|move|trash|rename|update|color|lock|unlock|resetimapuid|copy
     * For MsgAction     - delete|read|flag|tag|move|update|spam|trash
     * For ConvAction    - delete|read|flag|priority|tag|move|spam|trash
     * For FolderAction  - read|delete|rename|move|trash|empty|color|[!]grant|revokeorphangrants|url|import|sync|fb|[!]check|update|[!]syncon|retentionpolicy|[!]disableactivesync|webofflinesyncdays
     * For TagAction     - read|rename|color|delete|update|retentionpolicy
     * For ContactAction - move|delete|flag|trash|tag|update
     * For DistributionListAction -
     *    delete         delete the list
     *    rename         rename the list
     *    modify         modify the list
     *    addOwners      add list owner
     *    removeOwners   remove list owners
     *    setOwners      set list owners
     *    grantRights    grant rights
     *    revokeRights   revoke rights
     *    setRights      set rights
     *    addMembers     add list members
     *    removeMembers  remove list members
     *    acceptSubsReq  accept subscription/un-subscription request
     *    rejectSubsReq  reject subscription/un-subscription request
     *    resetimapuid   reset IMAP item UIDs
     *
     * @var string
     */
    #[Accessor(getter: "getOperation", setter: "setOperation")]
    #[SerializedName("op")]
    #[Type("string")]
    #[XmlAttribute]
    private string $operation = "";

    /**
     * List of characters; constrains the set of affected items in a conversation. t|j|s|d|o
     * t:   include items in the Trash
     * j:   include items in Spam/Junk
     * s:   include items in the user's Sent folder (not necessarily "Sent")
     * d:   include items in Drafts folder
     * o:   include items in any other folder
     * A leading '-' means to negate the constraint (e.g. "-t" means all messages not in Trash)
     *
     * @var string
     */
    #[Accessor(getter: "getConstraint", setter: "setConstraint")]
    #[SerializedName("tcon")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $constraint = null;

    /**
     * Deprecated - use "tn" instead
     *
     * @var int
     */
    #[Accessor(getter: "getTag", setter: "setTag")]
    #[SerializedName("tag")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $tag = null;

    /**
     * Folder ID
     *
     * @var string
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folder = null;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     *
     * @var string
     */
    #[Accessor(getter: "getRgb", setter: "setRgb")]
    #[SerializedName("rgb")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $rgb = null;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     *
     * @var int
     */
    #[Accessor(getter: "getColor", setter: "setColor")]
    #[SerializedName("color")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $color = null;

    /**
     * Name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $name = null;

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
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     *
     * @var string
     */
    #[Accessor(getter: "getTags", setter: "setTags")]
    #[SerializedName("t")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $tags = null;

    /**
     * Comma-separated list of tag names
     *
     * @var string
     */
    #[Accessor(getter: "getTagNames", setter: "setTagNames")]
    #[SerializedName("tn")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $tagNames = null;

    /**
     * Flag to signify that any non-existent ids should be returned
     *
     * @var bool
     */
    #[Accessor(getter: "getNonExistentIds", setter: "setNonExistentIds")]
    #[SerializedName("nei")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $nonExistentIds = null;

    /**
     * Flag to signify that ids of new items should be returned applies to COPY action
     *
     * @var bool
     */
    #[Accessor(getter: "getNewlyCreatedIds", setter: "setNewlyCreatedIds")]
    #[SerializedName("nci")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $newlyCreatedIds = null;

    /**
     * Constructor
     *
     * @param  string $operation
     * @param  string $ids
     * @param  string $constraint
     * @param  int $tag
     * @param  string $folder
     * @param  string $rgb
     * @param  int $color
     * @param  string $name
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  bool $nonExistentIds
     * @param  bool $newlyCreatedIds
     * @return self
     */
    public function __construct(
        string $operation = "",
        ?string $ids = null,
        ?string $constraint = null,
        ?int $tag = null,
        ?string $folder = null,
        ?string $rgb = null,
        ?int $color = null,
        ?string $name = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?bool $nonExistentIds = null,
        ?bool $newlyCreatedIds = null
    ) {
        $this->setOperation($operation);
        if (null !== $ids) {
            $this->setIds($ids);
        }
        if (null !== $constraint) {
            $this->setConstraint($constraint);
        }
        if (null !== $tag) {
            $this->setTag($tag);
        }
        if (null !== $folder) {
            $this->setFolder($folder);
        }
        if (null !== $rgb) {
            $this->setRgb($rgb);
        }
        if (null !== $color) {
            $this->setColor($color);
        }
        if (null !== $name) {
            $this->setName($name);
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
        if (null !== $nonExistentIds) {
            $this->setNonExistentIds($nonExistentIds);
        }
        if (null !== $newlyCreatedIds) {
            $this->setNewlyCreatedIds($newlyCreatedIds);
        }
    }

    /**
     * Get ids
     *
     * @return string
     */
    public function getIds(): ?string
    {
        return $this->ids;
    }

    /**
     * Set ids
     *
     * @param  string $ids
     * @return self
     */
    public function setIds(string $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    /**
     * Get operation
     *
     * @return string
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }

    /**
     * Set operation
     *
     * @param  string $operation
     * @return self
     */
    public function setOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * Get nonExistentIds
     *
     * @return bool
     */
    public function getNonExistentIds(): ?bool
    {
        return $this->nonExistentIds;
    }

    /**
     * Set nonExistentIds
     *
     * @param  bool $nonExistentIds
     * @return self
     */
    public function setNonExistentIds(bool $nonExistentIds): self
    {
        $this->nonExistentIds = $nonExistentIds;
        return $this;
    }

    /**
     * Get newlyCreatedIds
     *
     * @return bool
     */
    public function getNewlyCreatedIds(): ?bool
    {
        return $this->newlyCreatedIds;
    }

    /**
     * Set newlyCreatedIds
     *
     * @param  bool $newlyCreatedIds
     * @return self
     */
    public function setNewlyCreatedIds(bool $newlyCreatedIds): self
    {
        $this->newlyCreatedIds = $newlyCreatedIds;
        return $this;
    }

    /**
     * Get constraint
     *
     * @return string
     */
    public function getConstraint(): ?string
    {
        return $this->constraint;
    }

    /**
     * Set constraint
     *
     * @param  string $constraint
     * @return self
     */
    public function setConstraint(string $constraint): self
    {
        $this->constraint = $constraint;
        return $this;
    }

    /**
     * Get tag
     *
     * @return int
     */
    public function getTag(): ?int
    {
        return $this->tag;
    }

    /**
     * Set tag
     *
     * @param  int $tag
     * @return self
     */
    public function setTag(int $tag): self
    {
        $this->tag = $tag;
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
     * Get rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Set rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb(string $rgb): self
    {
        $this->rgb = $rgb;
        return $this;
    }

    /**
     * Get color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Set color
     *
     * @param  int $color
     * @return self
     */
    public function setColor(int $color): self
    {
        $this->color = in_array($color, range(0, 127)) ? $color : 0;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
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
     * Get tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set tagNames
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
        return $this;
    }
}
