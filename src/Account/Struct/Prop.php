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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * Property struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class Prop
{
    /**
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("string")
     * @XmlAttribute
     */
    private $zimlet;

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
     * Constructor method for property
     * @param  string $zimlet
     * @param  string $name
     * @param  string $value
     * @return self
     */
    public function __construct(string $zimlet, string $name, ?string $value = NULL)
    {
        $this->setZimlet($zimlet)
            ->setName($name);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets zimlet name
     *
     * @return string
     */
    public function getZimlet(): string
    {
        return $this->zimlet;
    }

    /**
     * Sets zimlet name
     *
     * @param  string $zimlet
     * @return self
     */
    public function setZimlet(string $zimlet): self
    {
        $this->zimlet = $zimlet;
        return $this;
    }

    /**
     * Gets property name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets property name
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
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
