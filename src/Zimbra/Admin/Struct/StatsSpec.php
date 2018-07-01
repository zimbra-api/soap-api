<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * StatsSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
    private $_values;

    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("string")
     * @XmlAttribute
     */
    private $_limit;

    /**
     * Constructor method for StatsSpec
     * @param  StatsValueWrapper $values
     * @param  string $name
     * @param  string $limit
     * @return self
     */
    public function __construct(StatsValueWrapper $values, $name = NULL, $limit = NULL)
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
    public function getValues()
    {
        return $this->_values;
    }

    /**
     * Sets the values.
     *
     * @param  StatsValueWrapper $values
     * @return self
     */
    public function setValues(StatsValueWrapper $values)
    {
        $this->_values = $values;
        return $this;
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets the limit
     *
     * @return string
     */
    public function getLimit()
    {
        return $this->_limit;
    }

    /**
     * Sets the limit
     *
     * @param  string $limit
     * @return self
     */
    public function setLimit($limit)
    {
        $this->_limit = trim($limit);
        return $this;
    }
}
