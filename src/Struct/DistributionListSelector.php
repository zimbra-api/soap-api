<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Enum\DistributionListBy as DLBy;

/**
 * DistributionListSelector class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DistributionListSelector
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Enum\DistributionListBy")
     * @XmlAttribute
     */
    private $by;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for DistributionListSelector
     * @param  DLBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(DLBy $by, ?string $value = NULL)
    {
        $this->setBy($by);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets by selector
     *
     * @return DLBy
     */
    public function getBy(): DLBy
    {
        return $this->by;
    }

    /**
     * Sets by selector
     *
     * @param  DLBy $by
     * @return self
     */
    public function setBy(DLBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
