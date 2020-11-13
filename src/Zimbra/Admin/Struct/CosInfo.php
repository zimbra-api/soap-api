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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};

/**
 * CosInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="cos")
 */
class CosInfo implements AdminObjectInterface
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Flag whether is the default Class Of Service (COS)
     * @Accessor(getter="getIsDefaultCos", setter="setIsDefaultCos")
     * @SerializedName("isDefaultCos")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isDefaultCos;

    /**
     * @Accessor(getter="getAttrList", setter="setAttrList")
     * @SerializedName("a")
     * @Type("array<Zimbra\Admin\Struct\CosInfoAttr>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attrs;

    /**
     * Constructor method for CosInfo
     * 
     * @param  string $name Name
     * @param  string $id ID
     * @param  array  $attrs Attributes
     * @return self
     */
    public function __construct($name, $id, $isDefaultCos = NULL, array $attrs = [])
    {
        $this->setName($name)
             ->setId($id)
             ->setAttrList($attrs);
        if (NULL !== $isDefaultCos) {
            $this->setIsDefaultCos($isDefaultCos);
        }
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
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets isDefaultCos
     *
     * @return bool
     */
    public function getIsDefaultCos(): bool
    {
        return $this->isDefaultCos;
    }

    /**
     * Sets isDefaultCos
     *
     * @param  bool $isDefaultCos
     * @return self
     */
    public function setIsDefaultCos($isDefaultCos): self
    {
        $this->isDefaultCos = (bool) $isDefaultCos;
        return $this;
    }

    /**
     * Add an attr
     *
     * @param  CosInfoAttr $attr
     * @return self
     */
    public function addAttr(CosInfoAttr $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Sets attributes
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrList(array $attrs): self
    {
        $this->attrs = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof CosInfoAttr) {
                $this->attrs[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attributes
     *
     * @return array
     */
    public function getAttrList(): array
    {
        return $this->attrs;
    }
}
