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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};
use Zimbra\Common\Enum\{DistributionListGranteeBy, GranteeType};

/**
 * DistributionListGranteeSelector struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListGranteeSelector
{
    /**
     * Type
     *
     * @var GranteeType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[XmlAttribute]
    private GranteeType $type;

    /**
     * Grantee by
     *
     * @var DistributionListGranteeBy
     */
    #[Accessor(getter: "getBy", setter: "setBy")]
    #[SerializedName("by")]
    #[XmlAttribute]
    private DistributionListGranteeBy $by;

    /**
     * Value
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
     * @param GranteeType $type
     * @param DistributionListGranteeBy $by
     * @param string $value
     * @return self
     */
    public function __construct(
        ?GranteeType $type = null,
        ?DistributionListGranteeBy $by = null,
        ?string $value = null
    ) {
        $this->setType($type ?? GranteeType::ALL)->setBy(
            $by ?? DistributionListGranteeBy::NAME
        );
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get grantee type
     *
     * @return GranteeType
     */
    public function getType(): GranteeType
    {
        return $this->type;
    }

    /**
     * Set grantee type
     *
     * @param  GranteeType $type
     * @return self
     */
    public function setType(GranteeType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get grantee by
     *
     * @return DistributionListGranteeBy
     */
    public function getBy(): DistributionListGranteeBy
    {
        return $this->by;
    }

    /**
     * Set grantee by
     *
     * @param  DistributionListGranteeBy $by
     * @return self
     */
    public function setBy(DistributionListGranteeBy $by): self
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
