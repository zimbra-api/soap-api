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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};

use Zimbra\Enum\ContactActionOp;

/**
 * ContactActionSelector class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="action")
 */
class ContactActionSelector extends ActionSelector
{
    /**
     * New Contact attributes
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attr")
     * @Type("array<Zimbra\Mail\Struct\NewContactAttr>")
     * @XmlList(inline = true, entry = "attr")
     */
    private $attrs = [];

    /**
     * Constructor method for ContactActionSelector
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
        string $operation,
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
            $operation, $ids, $constraint, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames, $nonExistentIds, $newlyCreatedIds
        );
        $this->setAttrs($attrs);
    }

    /**
     * Sets operation
     *
     * @param  string $operation
     * @return self
     */
    public function setOperation(string $operation): self
    {
        if (ContactActionOp::isValid($operation)) {
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
        $this->attrs = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof NewContactAttr) {
                $this->attrs[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }
}