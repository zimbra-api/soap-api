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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};

/**
 * ChildAccount struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ChildAccount
{
    /**
     * Child account ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private string $id;

    /**
     * Child account name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Flag whether child account is visible or not
     *
     * @var bool
     */
    #[Accessor(getter: "isVisible", setter: "setIsVisible")]
    #[SerializedName("visible")]
    #[Type("bool")]
    #[XmlAttribute]
    private bool $isVisible;

    /**
     * Flag whether child account is active or not
     *
     * @var bool
     */
    #[Accessor(getter: "isActive", setter: "setIsActive")]
    #[SerializedName("active")]
    #[Type("bool")]
    #[XmlAttribute]
    private bool $isActive;

    /**
     * Attributes of the child account, including displayName
     *
     * @var array
     */
    #[Accessor(getter: "getAttrs", setter: "setAttrs")]
    #[SerializedName("attrs")]
    #[Type("array<Zimbra\Account\Struct\Attr>")]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    #[XmlList(inline: false, entry: "attr", namespace: "urn:zimbraAccount")]
    private array $attrs = [];

    /**
     * Constructor
     *
     * @param string $id
     * @param string $name
     * @param bool $isVisible
     * @param bool $isActive
     * @param array $attrs
     * @return self
     */
    public function __construct(
        string $id = "",
        string $name = "",
        bool $isVisible = false,
        bool $isActive = false,
        array $attrs = []
    ) {
        $this->setId($id)
            ->setName($name)
            ->setIsVisible($isVisible)
            ->setIsActive($isActive)
            ->setAttrs($attrs);
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get isVisible
     *
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    /**
     * Set isVisible
     *
     * @param  bool $isVisible
     * @return self
     */
    public function setIsVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;
        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * Set isActive
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
     * Get attributes
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Set attributes
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter(
            $attrs,
            static fn($attr) => $attr instanceof Attr
        );
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
