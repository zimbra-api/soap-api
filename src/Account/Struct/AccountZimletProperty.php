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
use Zimbra\Common\Struct\ZimletProperty;

/**
 * AccountZimletProperty struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountZimletProperty implements ZimletProperty
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
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
     * @param  string $name
     * @param  string $value
     * @return self
     */
    public function __construct(?string $name = null, ?string $value = null)
    {
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name
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
