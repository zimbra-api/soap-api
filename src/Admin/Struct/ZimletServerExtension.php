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
use Zimbra\Common\Struct\ZimletServerExtensionInterface;

/**
 * ZimletServerExtension class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ZimletServerExtension implements ZimletServerExtensionInterface
{
    /**
     * Keyword
     * 
     * @Accessor(getter="getHasKeyword", setter="setHasKeyword")
     * @SerializedName("hasKeyword")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getHasKeyword', setter: 'setHasKeyword')]
    #[SerializedName(name: 'hasKeyword')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $hasKeyword;

    /**
     * Extension class
     * 
     * @Accessor(getter="getExtensionClass", setter="setExtensionClass")
     * @SerializedName("extensionClass")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getExtensionClass', setter: 'setExtensionClass')]
    #[SerializedName(name: 'extensionClass')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $extensionClass;

    /**
     * Regex
     * 
     * @Accessor(getter="getRegex", setter="setRegex")
     * @SerializedName("regex")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getRegex', setter: 'setRegex')]
    #[SerializedName(name: 'regex')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $regex;

    /**
     * Constructor
     * 
     * @param string $hasKeyword
     * @param string $extensionClass
     * @param string $regex
     * @return self
     */
    public function __construct(
        ?string $hasKeyword = NULL,
        ?string $extensionClass = NULL,
        ?string $regex = NULL
    )
    {
        if (NULL !== $hasKeyword) {
            $this->setHasKeyword($hasKeyword);
        }
        if (NULL !== $extensionClass) {
            $this->setExtensionClass($extensionClass);
        }
        if (NULL !== $regex) {
            $this->setRegex($regex);
        }
    }

    /**
     * Get hasKeyword
     *
     * @return string
     */
    public function getHasKeyword(): ?string
    {
        return $this->hasKeyword;
    }

    /**
     * Set hasKeyword
     *
     * @param  string $hasKeyword
     * @return self
     */
    public function setHasKeyword(string $hasKeyword): self
    {
        $this->hasKeyword = $hasKeyword;
        return $this;
    }

    /**
     * Get extensionClass
     *
     * @return string
     */
    public function getExtensionClass(): ?string
    {
        return $this->extensionClass;
    }

    /**
     * Set extensionClass
     *
     * @param  string $extensionClass
     * @return self
     */
    public function setExtensionClass(string $extensionClass): self
    {
        $this->extensionClass = $extensionClass;
        return $this;
    }

    /**
     * Get regex
     *
     * @return string
     */
    public function getRegex(): ?string
    {
        return $this->regex;
    }

    /**
     * Set regex
     *
     * @param  string $regex
     * @return self
     */
    public function setRegex(string $regex): self
    {
        $this->regex = $regex;
        return $this;
    }
}
