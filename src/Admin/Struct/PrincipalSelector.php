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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};
use Zimbra\Common\Enum\AutoProvPrincipalBy;

/**
 * PrincipalSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class PrincipalSelector
{
    /**
     * Meaning determined by {principal-selector-by}
     *
     * @var AutoProvPrincipalBy
     */
    #[Accessor(getter: "getBy", setter: "setBy")]
    #[SerializedName("by")]
    #[XmlAttribute]
    private AutoProvPrincipalBy $by;

    /**
     * The key used to identify the principal
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private ?string $value = null;

    /**
     * Constructor
     *
     * @param  AutoProvPrincipalBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(
        ?AutoProvPrincipalBy $by = null,
        ?string $value = null
    ) {
        $this->setBy($by ?? AutoProvPrincipalBy::DN);
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get by enum
     *
     * @return AutoProvPrincipalBy
     */
    public function getBy(): AutoProvPrincipalBy
    {
        return $this->by;
    }

    /**
     * Set by enum
     *
     * @param  AutoProvPrincipalBy $by
     * @return self
     */
    public function setBy(AutoProvPrincipalBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
