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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\LocaleInterface;

/**
 * LocaleInfo class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class LocaleInfo implements LocaleInterface
{
    /**
     * Locale ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private string $id;

    /**
     * Name of the locale in the locale itself
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Name of the locale in the users' locale
     *
     * @var string
     */
    #[Accessor(getter: "getLocalName", setter: "setLocalName")]
    #[SerializedName("localName")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $localName = null;

    /**
     * Constructor
     *
     * @param string $id
     * @param string $name
     * @param string $localName
     * @return self
     */
    public function __construct(
        string $id = "",
        string $name = "",
        ?string $localName = null
    ) {
        $this->setId($id)->setName($name);
        if (null !== $localName) {
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
