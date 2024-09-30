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
 * DocumentActionResult class
 * Document action response
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DocumentActionResult extends ActionResult
{
    /**
     * Grantee Zimbra ID
     *
     * @var string
     */
    #[Accessor(getter: "getZimbraId", setter: "setZimbraId")]
    #[SerializedName("zid")]
    #[Type("string")]
    #[XmlAttribute]
    private $zimbraId;

    /**
     * Display name
     *
     * @var string
     */
    #[Accessor(getter: "getDisplayName", setter: "setDisplayName")]
    #[SerializedName("d")]
    #[Type("string")]
    #[XmlAttribute]
    private $displayName;

    /**
     * Access key (Password)
     *
     * @var string
     */
    #[Accessor(getter: "getAccessKey", setter: "setAccessKey")]
    #[SerializedName("key")]
    #[Type("string")]
    #[XmlAttribute]
    private $accessKey;

    /**
     * Constructor
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
        string $id = "",
        string $operation = "",
        ?string $nonExistentIds = null,
        ?string $newlyCreatedIds = null,
        ?string $zimbraId = null,
        ?string $displayName = null,
        ?string $accessKey = null
    ) {
        parent::__construct($id, $operation, $nonExistentIds, $newlyCreatedIds);
        if (null !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (null !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (null !== $accessKey) {
            $this->setAccessKey($accessKey);
        }
    }

    /**
     * Get zimbraId
     *
     * @return string
     */
    public function getZimbraId(): ?string
    {
        return $this->zimbraId;
    }

    /**
     * Set zimbraId
     *
     * @param  string $zimbraId
     * @return self
     */
    public function setZimbraId(string $zimbraId): self
    {
        $this->zimbraId = $zimbraId;
        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Set displayName
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
     * Get accessKey
     *
     * @return string
     */
    public function getAccessKey(): ?string
    {
        return $this->accessKey;
    }

    /**
     * Set accessKey
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
