<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * CosInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CosInfo implements AdminObjectInterface
{
    /**
     * Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Flag whether is the default Class Of Service (COS)
     * 
     * @var bool
     */
    #[Accessor(getter: 'getIsDefaultCos', setter: 'setIsDefaultCos')]
    #[SerializedName('isDefaultCos')]
    #[Type('bool')]
    #[XmlAttribute]
    private $isDefaultCos;

    /**
     * Attribute list
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttrList', setter: 'setAttrList')]
    #[Type('array<Zimbra\Admin\Struct\CosInfoAttr>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraAdmin')]
    private $attrs = [];

    /**
     * Constructor
     * 
     * @param  string $name 
     * @param  string $id
     * @param  bool $isDefaultCos
     * @param  array  $attrs Attributes
     * @return self
     */
    public function __construct(
        string $name = '', string $id = '', ?bool $isDefaultCos = null, array $attrs = []
    )
    {
        $this->setName($name)
             ->setId($id)
             ->setAttrList($attrs);
        if (null !== $isDefaultCos) {
            $this->setIsDefaultCos($isDefaultCos);
        }
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
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
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
     * Get isDefaultCos
     *
     * @return bool
     */
    public function getIsDefaultCos(): ?bool
    {
        return $this->isDefaultCos;
    }

    /**
     * Set isDefaultCos
     *
     * @param  bool $isDefaultCos
     * @return self
     */
    public function setIsDefaultCos(bool $isDefaultCos): self
    {
        $this->isDefaultCos = $isDefaultCos;
        return $this;
    }

    /**
     * Set attributes
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrList(array $attrs): self
    {
        $this->attrs = array_filter(
            $attrs, static fn ($attr) => $attr instanceof CosInfoAttr
        );
        return $this;
    }

    /**
     * Get attributes
     *
     * @return array
     */
    public function getAttrList(): array
    {
        return $this->attrs;
    }
}
