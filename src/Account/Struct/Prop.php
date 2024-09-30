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
    XmlValue
};

/**
 * Property struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Prop
{
    /**
     * Zimlet
     *
     * @var string
     */
    #[Accessor(getter: "getZimlet", setter: "setZimlet")]
    #[SerializedName("zimlet")]
    #[Type("string")]
    #[XmlAttribute]
    private $zimlet;

    /**
     * Name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * Value
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     *
     * @param  string $zimlet
     * @param  string $name
     * @param  string $value
     * @return self
     */
    public function __construct(
        string $zimlet = "",
        string $name = "",
        ?string $value = null
    ) {
        $this->setZimlet($zimlet)->setName($name);
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get zimlet name
     *
     * @return string
     */
    public function getZimlet(): string
    {
        return $this->zimlet;
    }

    /**
     * Set zimlet name
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
     * Get property name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set property name
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
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
