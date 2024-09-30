<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * SectionAttr class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SectionAttr
{
    /**
     * Metadata section key
     *
     * @Accessor(getter="getSection", setter="setSection")
     * @SerializedName("section")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSection", setter: "setSection")]
    #[SerializedName("section")]
    #[Type("string")]
    #[XmlAttribute]
    private $section;

    /**
     * Constructor
     *
     * @param string $section
     * @return self
     */
    public function __construct(string $section = "")
    {
        $this->setSection($section);
    }

    /**
     * Get attribute section
     *
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * Set attribute section
     *
     * @param  string $section
     * @return self
     */
    public function setSection(string $section): self
    {
        $this->section = $section;
        return $this;
    }
}
