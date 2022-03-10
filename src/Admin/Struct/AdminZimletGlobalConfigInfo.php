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
use Zimbra\Struct\{ZimletGlobalConfigInfo, ZimletProperty};

/**
 * AdminZimletGlobalConfigInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AdminZimletGlobalConfigInfo implements ZimletGlobalConfigInfo
{
    /**
     * Global zimlet configuration property
     * 
     * @Accessor(getter="getZimletProperties", setter="setZimletProperties")
     * @SerializedName("property")
     * @Type("array<Zimbra\Admin\Struct\AdminZimletProperty>")
     * @XmlList(inline = true, entry = "property")
     */
    private $properties = [];

    /**
     * Constructor method for AdminZimletHostConfigInfo
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
        if ($property instanceof AdminZimletProperty) {
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
            if ($property instanceof AdminZimletProperty) {
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
