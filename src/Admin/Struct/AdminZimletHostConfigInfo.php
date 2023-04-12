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
use Zimbra\Common\Struct\{ZimletHostConfigInfo, ZimletProperty};

/**
 * AdminZimletHostConfigInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AdminZimletHostConfigInfo implements ZimletHostConfigInfo
{
    /**
     * Designates the zimbra host name for the properties.
     * Must be a valid Zimbra host name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Host specifice zimlet configuration properties
     * 
     * @var array
     */
    #[Accessor(getter: 'getZimletProperties', setter: 'setZimletProperties')]
    #[Type('array<Zimbra\Admin\Struct\AdminZimletProperty>')]
    #[XmlList(inline: true, entry: 'property', namespace: 'urn:zimbraAdmin')]
    private $properties = [];

    /**
     * Constructor
     * 
     * @param  string $name
     * @param  array $properties
     * @return self
     */
    public function __construct(?string $name = NULL, array $properties = [])
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        $this->setZimletProperties($properties);
    }

    /**
     * Get zimbra host name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set zimbra host name
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
        if ($property instanceof AdminZimletProperty) {
            $this->properties[] = $property;
        }
        return $this;
    }

    /**
     * Set properties
     *
     * @param  array $properties
     * @return self
     */
    public function setZimletProperties(array $properties): self
    {
        $this->properties = array_filter($properties, static fn ($prop) => $prop instanceof AdminZimletProperty);
        return $this;
    }

    /**
     * Get properties
     *
     * @return array
     */
    public function getZimletProperties(): array
    {
        return $this->properties;
    }
}
