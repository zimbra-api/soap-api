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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * StatsSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="stats")
 */
class StatsSpec
{
    /**
     * @Accessor(getter="getValues", setter="setValues")
     * @SerializedName("values")
     * @Type("Zimbra\Admin\Struct\StatsValueWrapper")
     * @XmlElement
     */
    private $values;

    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("string")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Constructor method for StatsSpec
     * @param  StatsValueWrapper $values
     * @param  string $name
     * @param  string $limit
     * @return self
     */
    public function __construct(StatsValueWrapper $values, ?string $name = NULL, ?string $limit = NULL)
    {
        $this->setValues($values);
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
    }

    /**
     * Gets the values.
     *
     * @return StatsValueWrapper
     */
    public function getValues(): StatsValueWrapper
    {
        return $this->values;
    }

    /**
     * Sets the values.
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
     * Gets the name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets the name
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
     * Gets the limit
     *
     * @return string
     */
    public function getLimit(): ?string
    {
        return $this->limit;
    }

    /**
     * Sets the limit
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