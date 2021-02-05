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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Struct\{ZimletGlobalConfigInfo, ZimletProperty};

/**
 * AccountZimletGlobalConfigInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="global")
 */
class AccountZimletGlobalConfigInfo implements ZimletGlobalConfigInfo
{
    /**
     * Global zimlet configuration property
     * 
     * @Accessor(getter="getZimletProperties", setter="setZimletProperties")
     * @SerializedName("property")
     * @Type("array<Zimbra\Account\Struct\AccountZimletProperty>")
     * @XmlList(inline = true, entry = "property")
     */
    private $properties = [];

    /**
     * Constructor method for AccountZimletHostConfigInfo
     * @param  array $properties
     * @return self
     */
    public function __construct(array $properties = [])
    {
        $this->setZimletProperties($properties);
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