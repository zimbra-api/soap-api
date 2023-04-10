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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * DocumentActionSelector class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DocumentActionSelector extends ActionSelector
{
    /**
     * Zimbra ID of the grant to revoke (Used for "!grant" operation)
     * 
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getZimbraId', setter: 'setZimbraId')]
    #[SerializedName('zid')]
    #[Type('string')]
    #[XmlAttribute]
    private $zimbraId;

    /**
     * Used for "grant" operation
     * 
     * @Accessor(getter="getGrant", setter="setGrant")
     * @SerializedName("grant")
     * @Type("Zimbra\Mail\Struct\DocumentActionGrant")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var DocumentActionGrant
     */
    #[Accessor(getter: 'getGrant', setter: 'setGrant')]
    #[SerializedName('grant')]
    #[Type('Zimbra\Mail\Struct\DocumentActionGrant')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $grant;

    /**
     * Constructor
     *
     * @param  string $operation
     * @param  string $ids
     * @param  string $zimbraId
     * @param  DocumentActionGrant $grant
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
        ?string $zimbraId = NULL,
        ?DocumentActionGrant $grant = NULL,
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
        parent::__construct(
            $operation,
            $ids,
            $constraint,
            $tag,
            $folder,
            $rgb,
            $color,
            $name,
            $flags,
            $tags,
            $tagNames,
            $nonExistentIds,
            $newlyCreatedIds
        );
        if (NULL !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if ($grant instanceof DocumentActionGrant) {
            $this->setGrant($grant);
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
     * Get grant
     *
     * @return DocumentActionGrant
     */
    public function getGrant(): ?DocumentActionGrant
    {
        return $this->grant;
    }

    /**
     * Set grant
     *
     * @param  DocumentActionGrant $grant
     * @return self
     */
    public function setGrant(DocumentActionGrant $grant): self
    {
        $this->grant = $grant;
        return $this;
    }
}
