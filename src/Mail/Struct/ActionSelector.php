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
use Zimbra\Common\Text;

/**
 * ActionSelector class
 * Action selector
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ActionSelector
{
    /**
     * Comma separated list of item IDs to act on.  Required except for TagActionRequest,
     * where the tags items can be specified using their tag names as an alternative.
     * @Accessor(getter="getIds", setter="setIds")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $ids;

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
     * @Accessor(getter="getOperation", setter="setOperation")
     * @SerializedName("op")
     * @Type("string")
     * @XmlAttribute
     */
    private $operation;

    /**
     * List of characters; constrains the set of affected items in a conversation. t|j|s|d|o
     * t:   include items in the Trash
     * j:   include items in Spam/Junk
     * s:   include items in the user's Sent folder (not necessarily "Sent")
     * d:   include items in Drafts folder
     * o:   include items in any other folder
     * A leading '-' means to negate the constraint (e.g. "-t" means all messages not in Trash)
     * @Accessor(getter="getConstraint", setter="setConstraint")
     * @SerializedName("tcon")
     * @Type("string")
     * @XmlAttribute
     */
    private $constraint;

    /**
     * Deprecated - use "tn" instead
     * @Accessor(getter="getTag", setter="setTag")
     * @SerializedName("tag")
     * @Type("integer")
     * @XmlAttribute
     */
    private $tag;

    /**
     * Folder ID
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folder;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * @Accessor(getter="getRgb", setter="setRgb")
     * @SerializedName("rgb")
     * @Type("string")
     * @XmlAttribute
     */
    private $rgb;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @Accessor(getter="getColor", setter="setColor")
     * @SerializedName("color")
     * @Type("integer")
     * @XmlAttribute
     */
    private $color;

    /**
     * Name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Flags
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
     * Flag to signify that any non-existent ids should be returned
     * @Accessor(getter="getNonExistentIds", setter="setNonExistentIds")
     * @SerializedName("nei")
     * @Type("bool")
     * @XmlAttribute
     */
    private $nonExistentIds;

    /**
     * Flag to signify that ids of new items should be returned applies to COPY action
     * @Accessor(getter="getNewlyCreatedIds", setter="setNewlyCreatedIds")
     * @SerializedName("nci")
     * @Type("bool")
     * @XmlAttribute
     */
    private $newlyCreatedIds;

    /**
     * Constructor method for ActionSelector
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
        string $operation = '',
        ?string $ids = NULL,
        ?string $constraint = NULL,
        ?int $tag = NULL,
        ?string $folder = NULL,
        ?string $rgb = NULL,
        ?int $color = NULL,
        ?string $name = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?bool $nonExistentIds = NULL,
        ?bool $newlyCreatedIds = NULL
    )
    {
        $this->setOperation($operation);
        if (NULL !== $ids) {
            $this->setIds($ids);
        }
        if (NULL !== $constraint) {
            $this->setConstraint($constraint);
        }
        if (NULL !== $tag) {
            $this->setTag($tag);
        }
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        if (NULL !== $rgb) {
            $this->setRgb($rgb);
        }
        if (NULL !== $color) {
            $this->setColor($color);
        }
        if (NULL !== $name) {
            $this->setName($name);
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
        if (NULL !== $nonExistentIds) {
            $this->setNonExistentIds($nonExistentIds);
        }
        if (NULL !== $newlyCreatedIds) {
            $this->setNewlyCreatedIds($newlyCreatedIds);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getIds(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setIds(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets operation
     *
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * Sets operation
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
     * Gets nonExistentIds
     *
     * @return bool
     */
    public function getNonExistentIds(): ?bool
    {
        return $this->nonExistentIds;
    }

    /**
     * Sets nonExistentIds
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
     * Gets newlyCreatedIds
     *
     * @return bool
     */
    public function getNewlyCreatedIds(): ?bool
    {
        return $this->newlyCreatedIds;
    }

    /**
     * Sets newlyCreatedIds
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
     * Gets constraint
     *
     * @return string
     */
    public function getConstraint(): ?string
    {
        return $this->constraint;
    }

    /**
     * Sets constraint
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
     * Gets tag
     *
     * @return int
     */
    public function getTag(): ?int
    {
        return $this->tag;
    }

    /**
     * Sets tag
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
     * Gets rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Sets rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb(string $rgb): self
    {
        if (Text::isRgb($rgb)) {
            $this->rgb = $rgb;
        }
        return $this;
    }

    /**
     * Gets color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Sets color
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
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
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
     * Gets tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Sets tagNames
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
