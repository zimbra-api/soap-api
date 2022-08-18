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
 * Preference struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Pref
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * @Accessor(getter="getModified", setter="setModified")
     * @SerializedName("modified")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getModified', setter: 'setModified')]
    #[SerializedName('modified')]
    #[Type('int')]
    #[XmlAttribute]
    private $modified;

    /**
     * Constructor
     * 
     * @param  string $name
     * @param  string $value
     * @param  int    $modified
     * @return self
     */
    public function __construct(
        string $name = '', ?string $value = NULL, ?int $modified = NULL
    )
    {
        $this->setName($name);
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $modified) {
            $this->setModified($modified);
        }
    }

    /**
     * Get preference name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set preference name
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

    /**
     * Get preference modified time
     *
     * @return int
     */
    public function getModified(): ?int
    {
        return $this->modified;
    }

    /**
     * Set preference modified time
     *
     * @param  int $modified
     * @return self
     */
    public function setModified(int $modified): self
    {
        $this->modified = $modified;
        return $this;
    }
}
