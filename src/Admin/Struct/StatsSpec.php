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
    XmlElement
};

/**
 * StatsSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class StatsSpec
{
    /**
     * @Accessor(getter="getValues", setter="setValues")
     * @SerializedName("values")
     * @Type("Zimbra\Admin\Struct\StatsValueWrapper")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var StatsValueWrapper
     */
    #[Accessor(getter: "getValues", setter: "setValues")]
    #[SerializedName("values")]
    #[Type(StatsValueWrapper::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private StatsValueWrapper $values;

    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getLimit", setter: "setLimit")]
    #[SerializedName("limit")]
    #[Type("string")]
    #[XmlAttribute]
    private $limit;

    /**
     * Constructor
     *
     * @param  StatsValueWrapper $values
     * @param  string $name
     * @param  string $limit
     * @return self
     */
    public function __construct(
        StatsValueWrapper $values,
        ?string $name = null,
        ?string $limit = null
    ) {
        $this->setValues($values);
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $limit) {
            $this->setLimit($limit);
        }
    }

    /**
     * Get the values.
     *
     * @return StatsValueWrapper
     */
    public function getValues(): StatsValueWrapper
    {
        return $this->values;
    }

    /**
     * Set the values.
     *
     * @param  StatsValueWrapper $values
     * @return self
     */
    public function setValues(StatsValueWrapper $values): self
    {
        $this->values = $values;
        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name
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
     * Get the limit
     *
     * @return string
     */
    public function getLimit(): ?string
    {
        return $this->limit;
    }

    /**
     * Set the limit
     *
     * @param  string $limit
     * @return self
     */
    public function setLimit(string $limit): self
    {
        $this->limit = $limit;
        return $this;
    }
}
