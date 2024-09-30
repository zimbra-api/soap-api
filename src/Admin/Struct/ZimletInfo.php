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

/**
 * ZimletInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ZimletInfo extends AdminObjectInfo
{
    /**
     * @Accessor(getter="getHasKeyword", setter="setHasKeyword")
     * @SerializedName("hasKeyword")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getHasKeyword", setter: "setHasKeyword")]
    #[SerializedName("hasKeyword")]
    #[Type("string")]
    #[XmlAttribute]
    private $hasKeyword;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  string $id
     * @param  array  $attrs
     * @param  string $hasKeyword
     * @return self
     */
    public function __construct(
        string $name = "",
        string $id = "",
        array $attrs = [],
        ?string $hasKeyword = null
    ) {
        parent::__construct($name, $id, $attrs);
        if (null !== $hasKeyword) {
            $this->setHasKeyword($hasKeyword);
        }
    }

    /**
     * Get Keyword
     *
     * @return string
     */
    public function getHasKeyword(): ?string
    {
        return $this->hasKeyword;
    }

    /**
     * Set Keyword
     *
     * @param  string $hasKeyword
     * @return self
     */
    public function setHasKeyword(string $hasKeyword): self
    {
        $this->hasKeyword = $hasKeyword;
        return $this;
    }
}
