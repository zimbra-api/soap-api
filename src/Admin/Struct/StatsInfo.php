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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * StatsInfo class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class StatsInfo
{
    /**
     * Stat name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Stats values
     * @Accessor(getter="getValues", setter="setValues")
     * @SerializedName("values")
     * @Type("Zimbra\Admin\Struct\StatsValues")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?StatsValues $values = NULL;

    /**
     * Constructor method for StatsInfo
     *
     * @param  string $name
     * @param  StatsValues $values
     * @return self
     */
    public function __construct(string $name, ?StatsValues $values = NULL)
    {
        $this->setName($name);
        if ($values instanceof StatsValues) {
            $this->setValues($values);
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
     * Sets values
     *
     * @param  StatsValues $values
     * @return self
     */
    public function setValues(StatsValues $values): self
    {
        $this->values = $values;
        return $this;
    }

    /**
     * Gets values
     *
     * @return StatsValues
     */
    public function getValues(): ?StatsValues
    {
        return $this->values;
    }
}
