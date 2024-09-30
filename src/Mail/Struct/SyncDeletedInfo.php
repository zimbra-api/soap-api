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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};

/**
 * SyncDeletedInfo class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SyncDeletedInfo
{
    /**
     * IDs of deleted items
     *
     * @var string
     */
    #[Accessor(getter: "getIds", setter: "setIds")]
    #[SerializedName("ids")]
    #[Type("string")]
    #[XmlAttribute]
    private $ids;

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getFolderTypes", setter: "setFolderTypes")]
    #[Type("array<Zimbra\Mail\Struct\FolderIdsAttr>")]
    #[XmlList(inline: true, entry: "folder", namespace: "urn:zimbraMail")]
    private $folderTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getSearchTypes", setter: "setSearchTypes")]
    #[Type("array<Zimbra\Mail\Struct\SearchFolderIdsAttr>")]
    #[XmlList(inline: true, entry: "search", namespace: "urn:zimbraMail")]
    private $searchTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getLinkTypes", setter: "setLinkTypes")]
    #[Type("array<Zimbra\Mail\Struct\MountIdsAttr>")]
    #[XmlList(inline: true, entry: "link", namespace: "urn:zimbraMail")]
    private $linkTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getTagTypes", setter: "setTagTypes")]
    #[Type("array<Zimbra\Mail\Struct\TagIdsAttr>")]
    #[XmlList(inline: true, entry: "tag", namespace: "urn:zimbraMail")]
    private $tagTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getConvTypes", setter: "setConvTypes")]
    #[Type("array<Zimbra\Mail\Struct\ConvIdsAttr>")]
    #[XmlList(inline: true, entry: "c", namespace: "urn:zimbraMail")]
    private $convTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getChatTypes", setter: "setChatTypes")]
    #[Type("array<Zimbra\Mail\Struct\ChatIdsAttr>")]
    #[XmlList(inline: true, entry: "chat", namespace: "urn:zimbraMail")]
    private $chatTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getMsgTypes", setter: "setMsgTypes")]
    #[Type("array<Zimbra\Mail\Struct\MsgIdsAttr>")]
    #[XmlList(inline: true, entry: "m", namespace: "urn:zimbraMail")]
    private $msgTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getContactTypes", setter: "setContactTypes")]
    #[Type("array<Zimbra\Mail\Struct\ContactIdsAttr>")]
    #[XmlList(inline: true, entry: "cn", namespace: "urn:zimbraMail")]
    private $contactTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getApptTypes", setter: "setApptTypes")]
    #[Type("array<Zimbra\Mail\Struct\ApptIdsAttr>")]
    #[XmlList(inline: true, entry: "appt", namespace: "urn:zimbraMail")]
    private $apptTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getTaskTypes", setter: "setTaskTypes")]
    #[Type("array<Zimbra\Mail\Struct\TaskIdsAttr>")]
    #[XmlList(inline: true, entry: "task", namespace: "urn:zimbraMail")]
    private $taskTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getNoteTypes", setter: "setNoteTypes")]
    #[Type("array<Zimbra\Mail\Struct\NoteIdsAttr>")]
    #[XmlList(inline: true, entry: "notes", namespace: "urn:zimbraMail")]
    private $noteTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getWikiTypes", setter: "setWikiTypes")]
    #[Type("array<Zimbra\Mail\Struct\WikiIdsAttr>")]
    #[XmlList(inline: true, entry: "w", namespace: "urn:zimbraMail")]
    private $wikiTypes = [];

    /**
     * Details of deletes broken down by item type (present if "typed" was specified in the request)
     *
     * @var array
     */
    #[Accessor(getter: "getDocTypes", setter: "setDocTypes")]
    #[Type("array<Zimbra\Mail\Struct\DocIdsAttr>")]
    #[XmlList(inline: true, entry: "doc", namespace: "urn:zimbraMail")]
    private $docTypes = [];

    /**
     * Constructor
     *
     * @param  string $ids
     * @param  array  $types
     * @return self
     */
    public function __construct(string $ids = "", array $types = [])
    {
        $this->setIds($ids)->setTypes($types);
    }

    /**
     * Set types
     *
     * @param  array $types
     * @return self
     */
    public function setTypes(array $types = []): self
    {
        $this->setFolderTypes($types)
            ->setSearchTypes($types)
            ->setLinkTypes($types)
            ->setTagTypes($types)
            ->setConvTypes($types)
            ->setChatTypes($types)
            ->setMsgTypes($types)
            ->setContactTypes($types)
            ->setApptTypes($types)
            ->setTaskTypes($types)
            ->setNoteTypes($types)
            ->setWikiTypes($types)
            ->setDocTypes($types);
        return $this;
    }

    /**
     * Get types
     *
     * @return array
     */
    public function getTypes(): array
    {
        return array_merge(
            $this->folderTypes,
            $this->searchTypes,
            $this->linkTypes,
            $this->tagTypes,
            $this->convTypes,
            $this->chatTypes,
            $this->msgTypes,
            $this->contactTypes,
            $this->apptTypes,
            $this->taskTypes,
            $this->noteTypes,
            $this->wikiTypes,
            $this->docTypes
        );
    }

    /**
     * Get ids
     *
     * @return string
     */
    public function getIds(): string
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
     * Set folderTypes
     *
     * @param  array $types
     * @return self
     */
    public function setFolderTypes(array $types): self
    {
        $this->folderTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof FolderIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get folderTypes
     *
     * @return array
     */
    public function getFolderTypes(): array
    {
        return $this->folderTypes;
    }

    /**
     * Set searchTypes
     *
     * @param  array $types
     * @return self
     */
    public function setSearchTypes(array $types): self
    {
        $this->searchTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof SearchFolderIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get searchTypes
     *
     * @return array
     */
    public function getSearchTypes(): array
    {
        return $this->searchTypes;
    }

    /**
     * Set linkTypes
     *
     * @param  array $types
     * @return self
     */
    public function setLinkTypes(array $types): self
    {
        $this->linkTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof MountIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get linkTypes
     *
     * @return array
     */
    public function getLinkTypes(): array
    {
        return $this->linkTypes;
    }

    /**
     * Set tagTypes
     *
     * @param  array $types
     * @return self
     */
    public function setTagTypes(array $types): self
    {
        $this->tagTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof TagIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get tagTypes
     *
     * @return array
     */
    public function getTagTypes(): array
    {
        return $this->tagTypes;
    }

    /**
     * Set convTypes
     *
     * @param  array $types
     * @return self
     */
    public function setConvTypes(array $types): self
    {
        $this->convTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof ConvIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get convTypes
     *
     * @return array
     */
    public function getConvTypes(): array
    {
        return $this->convTypes;
    }

    /**
     * Set chatTypes
     *
     * @param  array $types
     * @return self
     */
    public function setChatTypes(array $types): self
    {
        $this->chatTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof ChatIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get chatTypes
     *
     * @return array
     */
    public function getChatTypes(): array
    {
        return $this->chatTypes;
    }

    /**
     * Set msgTypes
     *
     * @param  array $types
     * @return self
     */
    public function setMsgTypes(array $types): self
    {
        $this->msgTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof MsgIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get msgTypes
     *
     * @return array
     */
    public function getMsgTypes(): array
    {
        return $this->msgTypes;
    }

    /**
     * Set contactTypes
     *
     * @param  array $types
     * @return self
     */
    public function setContactTypes(array $types): self
    {
        $this->contactTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof ContactIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get contactTypes
     *
     * @return array
     */
    public function getContactTypes(): array
    {
        return $this->contactTypes;
    }

    /**
     * Set apptTypes
     *
     * @param  array $types
     * @return self
     */
    public function setApptTypes(array $types): self
    {
        $this->apptTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof ApptIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get apptTypes
     *
     * @return array
     */
    public function getApptTypes(): array
    {
        return $this->apptTypes;
    }

    /**
     * Set taskTypes
     *
     * @param  array $types
     * @return self
     */
    public function setTaskTypes(array $types): self
    {
        $this->taskTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof TaskIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get taskTypes
     *
     * @return array
     */
    public function getTaskTypes(): array
    {
        return $this->taskTypes;
    }

    /**
     * Set noteTypes
     *
     * @param  array $types
     * @return self
     */
    public function setNoteTypes(array $types): self
    {
        $this->noteTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof NoteIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get noteTypes
     *
     * @return array
     */
    public function getNoteTypes(): array
    {
        return $this->noteTypes;
    }

    /**
     * Set wikiTypes
     *
     * @param  array $types
     * @return self
     */
    public function setWikiTypes(array $types): self
    {
        $this->wikiTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof WikiIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get wikiTypes
     *
     * @return array
     */
    public function getWikiTypes(): array
    {
        return $this->wikiTypes;
    }

    /**
     * Set docTypes
     *
     * @param  array $types
     * @return self
     */
    public function setDocTypes(array $types): self
    {
        $this->docTypes = array_values(
            array_filter(
                $types,
                static fn($type) => $type instanceof DocIdsAttr
            )
        );
        return $this;
    }

    /**
     * Get docTypes
     *
     * @return array
     */
    public function getDocTypes(): array
    {
        return $this->docTypes;
    }
}
