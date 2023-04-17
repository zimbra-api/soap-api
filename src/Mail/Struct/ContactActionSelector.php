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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Enum\ContactActionOp;

/**
 * ContactActionSelector class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactActionSelector extends ActionSelector
{
    /**
     * New contact attributes
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttrs', setter: 'setAttrs')]
    #[Type('array<Zimbra\Mail\Struct\NewContactAttr>')]
    #[XmlList(inline: true, entry: 'attr', namespace: 'urn:zimbraMail')]
    private $attrs = [];

    /**
     * Constructor
     *
     * @param  string $operation
     * @param  string $ids
     * @param  array $attrs
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
        array $attrs = [],
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
        $this->setAttrs($attrs);
    }

    /**
     * Set operation
     *
     * @param  string $operation
     * @return self
     */
    public function setOperation(string $operation): self
    {
        if (ContactActionOp::tryFrom($operation)) {
            parent::setOperation($operation);
        }
        return $this;
    }

    /**
     * Add attr
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
     * Set attrs
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter(
            $attrs, static fn ($attr) => $attr instanceof NewContactAttr
        );
        return $this;
    }

    /**
     * Get attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }
}
