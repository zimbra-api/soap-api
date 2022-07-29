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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * AccountWithModifications struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountWithModifications
{
    /**
     * Account ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     */
    private $id;

    /**
     * Serialized pending modifications per folder
     * @Accessor(getter="getPendingFolderModifications", setter="setPendingFolderModifications")
     * @Type("array<Zimbra\Mail\Struct\PendingFolderModifications>")
     * @XmlList(inline=true, entry="mods", namespace="urn:zimbraMail")
     */
    private $mods = [];

    /**
     * ID of the last change
     * @Accessor(getter="getLastChangeId", setter="setLastChangeId")
     * @SerializedName("changeid")
     * @Type("int")
     * @XmlAttribute
     */
    private $lastChangeId;

    /**
     * Constructor method for AccountWithModifications
     * @param  int $id
     * @param  array $mods
     * @param  int $lastChangeId
     * @return self
     */
    public function __construct(
        ?int $id = NULL,
        array $mods = [],
        ?int $lastChangeId = NULL
    )
    {
        $this->setPendingFolderModifications($mods);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $lastChangeId) {
            $this->setLastChangeId($lastChangeId);
        }
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  int $folderId
     * @return self
     */
    public function setId(int$id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get last change id
     *
     * @return int
     */
    public function getLastChangeId(): ?int
    {
        return $this->lastChangeId;
    }

    /**
     * Set last change id
     *
     * @param  int $lastChangeId
     * @return self
     */
    public function setLastChangeId(int $lastChangeId): self
    {
        $this->lastChangeId = $lastChangeId;
        return $this;
    }

    /**
     * Add pending modification folder
     *
     * @param  PendingFolderModifications $item
     * @return self
     */
    public function addPendingFolderModification(PendingFolderModifications $item): self
    {
        $this->mods[] = $item;
        return $this;
    }

    /**
     * Set pending modification folders
     *
     * @param array $mods
     * @return self
     */
    public function setPendingFolderModifications(array $mods): self
    {
        $this->mods = array_filter($mods, static fn ($mod) => $mod instanceof PendingFolderModifications);
        return $this;
    }

    /**
     * Get pending modification folders
     *
     * @return array
     */
    public function getPendingFolderModifications(): ?array
    {
        return $this->mods;
    }
}
