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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Struct\LocaleInterface;

/**
 * LocaleInfo class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="locale")
 */
class LocaleInfo implements LocaleInterface
{
    /**
     * Locale ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Name of the locale in the locale itself
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Name of the locale in the users' locale
     * @Accessor(getter="getLocalName", setter="setLocalName")
     * @SerializedName("localName")
     * @Type("string")
     * @XmlAttribute
     */
    private $localName;

    /**
     * Constructor method for LocaleInfo
     * @param string $id
     * @param string $name
     * @param string $localName
     * @return self
     */
    public function __construct(
        string $id,
        string $name,
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
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
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
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $target
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets localName
     *
     * @return string
     */
    public function getLocalName(): ?string
    {
        return $this->localName;
    }

    /**
     * Sets localName
     *
     * @param  string $localName
     * @return self
     */
    public function setLocalName($localName): self
    {
        $this->localName = $localName;
        return $this;
    }
}
