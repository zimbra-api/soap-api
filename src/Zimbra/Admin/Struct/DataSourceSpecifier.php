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
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

use Zimbra\Enum\DataSourceType;

/**
 * DataSourceSpecifier struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="dataSource")
 */
class DataSourceSpecifier extends AdminAttrsImpl
{
    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_type;

    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * Constructor method for DataSourceSpecifier
     * @param string $type Data source type
     * @param string $name Data source name
     * @param array $attrs Attributes
     * @return self
     */
    public function __construct($type, $name, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setType($type);
        $this->setName($name);
    }

    /**
     * Gets data source type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets data source type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        if (DataSourceType::has(trim($type))) {
            $this->_type = $type;
        }
        return $this;
    }

    /**
     * Gets data source name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets data source name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->_name = trim($name);
        return $this;
    }
}
