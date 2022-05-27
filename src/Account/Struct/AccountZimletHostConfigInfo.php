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
use Zimbra\Common\Struct\{ZimletHostConfigInfo, ZimletProperty};

/**
 * AccountZimletHostConfigInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AccountZimletHostConfigInfo implements ZimletHostConfigInfo
{
    /**
     * Designates the zimbra host name for the properties.
     * Must be a valid Zimbra host name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Host specifice zimlet configuration properties
     * 
     * @Accessor(getter="getZimletProperties", setter="setZimletProperties")
     * @SerializedName("property")
     * @Type("array<Zimbra\Account\Struct\AccountZimletProperty>")
     * @XmlList(inline = true, entry = "property")
     */
    private $properties = [];

    /**
     * Constructor method for AccountZimletHostConfigInfo
     * @param  string $name
     * @param  array $properties
     * @return self
     */
    public function __construct(?string $name = NULL, array $properties = [])
    {
        $this->setZimletProperties($properties);
        if (NULL !== $name) {
            $this->setName($name);
        }
    }

    /**
     * Gets zimbra host name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets zimbra host name
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
     * Add a property
     *
     * @param  ZimletProperty $property
     * @return self
     */
    public function addZimletProperty(ZimletProperty $property): self
    {
        if ($property instanceof AccountZimletProperty) {
            $this->properties[] = $property;
        }
        return $this;
    }

    /**
     * Sets properties
     *
     * @param  array $properties
     * @return self
     */
    public function setZimletProperties(array $properties): self
    {
        $this->properties = [];
        foreach ($properties as $property) {
            if ($property instanceof AccountZimletProperty) {
                $this->properties[] = $property;
            }
        }
        return $this;
    }

    /**
     * Gets properties
     *
     * @return array
     */
    public function getZimletProperties(): array
    {
        return $this->properties;
    }
}
