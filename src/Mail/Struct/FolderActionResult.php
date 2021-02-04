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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * FolderActionResult class
 * Folder action response
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="action")
 */
class FolderActionResult extends ActionResult
{
    /**
     * Grantee Zimbra ID
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     */
    private $zimbraId;

    /**
     * Display name
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $displayName;

    /**
     * Access key (Password)
     * @Accessor(getter="getAccessKey", setter="setAccessKey")
     * @SerializedName("key")
     * @Type("string")
     * @XmlAttribute
     */
    private $accessKey;

    /**
     * Constructor method for FolderActionResult
     *
     * @param  string $id
     * @param  string $operation
     * @param  string $nonExistentIds
     * @param  string $newlyCreatedIds
     * @param  string $zimbraId
     * @param  string $displayName
     * @param  string $accessKey
     * @return self
     */
    public function __construct(
        string $id,
        string $operation,
        ?string $nonExistentIds = NULL,
        ?string $newlyCreatedIds = NULL,
        ?string $zimbraId = NULL,
        ?string $displayName = NULL,
        ?string $accessKey = NULL
    )
    {
        parent::__construct($id, $operation, $nonExistentIds, $newlyCreatedIds);
        if (NULL !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (NULL !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (NULL !== $accessKey) {
            $this->setAccessKey($accessKey);
        }
    }

    /**
     * Gets zimbraId
     *
     * @return string
     */
    public function getZimbraId(): ?string
    {
        return $this->zimbraId;
    }

    /**
     * Sets zimbraId
     *
     * @param  string $id
     * @return self
     */
    public function setZimbraId(string $zimbraId): self
    {
        $this->zimbraId = $zimbraId;
        return $this;
    }

    /**
     * Gets displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Sets displayName
     *
     * @param  string $displayName
     * @return self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Gets accessKey
     *
     * @return string
     */
    public function getAccessKey(): ?string
    {
        return $this->accessKey;
    }

    /**
     * Sets accessKey
     *
     * @param  string $accessKey
     * @return self
     */
    public function setAccessKey(string $accessKey): self
    {
        $this->accessKey = $accessKey;
        return $this;
    }
}
