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
     * @var DocumentActionGrant
     */
    #[Accessor(getter: 'getGrant', setter: 'setGrant')]
    #[SerializedName('grant')]
    #[Type('Zimbra\Mail\Struct\DocumentActionGrant')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?DocumentActionGrant $grant;

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
        ?string $ids = null,
        ?string $zimbraId = null,
        ?DocumentActionGrant $grant = null,
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
        if (null !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        $this->grant = $grant;
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
