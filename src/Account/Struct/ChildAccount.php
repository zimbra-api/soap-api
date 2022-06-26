<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * ChildAccount struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ChildAccount
{
    /**
     * Child account ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Child account name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Flag whether child account is visible or not
     * @Accessor(getter="isVisible", setter="setIsVisible")
     * @SerializedName("visible")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isVisible;

    /**
     * Flag whether child account is active or not
     * @Accessor(getter="isActive", setter="setIsActive")
     * @SerializedName("active")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isActive;

    /**
     * Attributes of the child account, including displayName
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("array<Zimbra\Account\Struct\Attr>")
     * @XmlList(inline=false, entry="attr", namespace="urn:zimbraAccount")
     */
    private $attrs = [];

    /**
     * Constructor method for ChildAccount
     * 
     * @param string $id
     * @param string $name
     * @param bool $isVisible
     * @param bool $isActive
     * @param array $attrs
     * @return self
     */
    public function __construct(
        string $id,
        string $name,
        bool $isVisible = NULL,
        bool $isActive,
        array $attrs = []
    )
    {
        $this->setId($id)
             ->setName($name)
             ->setIsVisible($isVisible)
             ->setIsActive($isActive)
             ->setAttrs($attrs);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
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
     * Gets isVisible
     *
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    /**
     * Sets isVisible
     *
     * @param  string $isVisible
     * @return bool
     */
    public function setIsVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;
        return $this;
    }

    /**
     * Gets isActive
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * Sets isActive
     *
     * @param  bool $isActive
     * @return self
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * Gets attributes
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Sets attributes
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter($attrs, static fn ($attr) => $attr instanceof Attr);
        return $this;
    }

    /**
     * Add attribute
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }
}
