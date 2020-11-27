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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};

/**
 * Attr struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="attr")
 */
class Attr
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * @Accessor(getter="getPermDenied", setter="setPermDenied")
     * @SerializedName("pd")
     * @Type("bool")
     * @XmlAttribute
     */
    private $permDenied;

    /**
     * Constructor method for Attr
     * @param  string $name
     * @param  string $value
     * @param  bool   $pd
     * @return self
     */
    public function __construct(string $name, ?string $value = NULL, ?bool $pd = NULL)
    {
        $this->setName($name);
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $pd) {
            $this->setPermDenied($pd);
        }
    }

    /**
     * Gets name of attribute
     *
     * @param  string $name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name of attribute
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
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets permission has been denied flag
     *
     * @return bool
     */
    public function getPermDenied(): ?bool
    {
        return $this->permDenied;
    }

    /**
     * Sets permission has been denied flag
     *
     * @param  bool $pd
     * @return self
     */
    public function setPermDenied(bool $pd): self
    {
        $this->permDenied = $pd;
        return $this;
    }
}
