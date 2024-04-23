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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * TagActionSelector class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TagActionSelector extends ActionSelector
{
    /**
     * Retention policy
     * 
     * @var RetentionPolicy
     */
    #[Accessor(getter: 'getRetentionPolicy', setter: 'setRetentionPolicy')]
    #[SerializedName('retentionPolicy')]
    #[Type(RetentionPolicy::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?RetentionPolicy $retentionPolicy;

    /**
     * Constructor
     *
     * @param  string $operation
     * @param  RetentionPolicy $retentionPolicy
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
        ?RetentionPolicy $retentionPolicy = null,
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
        $this->retentionPolicy = $retentionPolicy;
    }

    /**
     * Get retention policy
     *
     * @return RetentionPolicy
     */
    public function getRetentionPolicy(): ?RetentionPolicy
    {
        return $this->retentionPolicy;
    }

    /**
     * Set retention policy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function setRetentionPolicy(RetentionPolicy $retentionPolicy): self
    {
        $this->retentionPolicy = $retentionPolicy;
        return $this;
    }
}
