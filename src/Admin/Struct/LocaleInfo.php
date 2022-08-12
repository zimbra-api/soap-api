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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\LocaleInterface;

/**
 * LocaleInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class LocaleInfo implements LocaleInterface
{
    /**
     * Locale ID.  e.g. "en_US"
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Locale name - the name in the locale itself.  e.g. "English (United States)"
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Locale name in the user's locale.  e.g. "English (United States)"
     * 
     * @Accessor(getter="getLocalName", setter="setLocalName")
     * @SerializedName("localName")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getLocalName', setter: 'setLocalName')]
    #[SerializedName(name: 'localName')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $localName;

    /**
     * Constructor
     * 
     * @param string $id
     * @param string $name
     * @param string $localName
     * @return self
     */
    public function __construct(
        string $id = '',
        string $name = '',
        ?string $localName = NULL
    )
    {
        $this->setId($id)
             ->setName($name);
        if (NULL !== $localName) {
            $this->setLocalName($localName);
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get localName
     *
     * @return string
     */
    public function getLocalName(): ?string
    {
        return $this->localName;
    }

    /**
     * Set localName
     *
     * @param  string $localName
     * @return self
     */
    public function setLocalName(string $localName): self
    {
        $this->localName = $localName;
        return $this;
    }
}
