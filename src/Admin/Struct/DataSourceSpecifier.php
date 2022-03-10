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
use Zimbra\Enum\DataSourceType;

/**
 * DataSourceSpecifier struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DataSourceSpecifier extends AdminAttrsImpl
{
    /**
     * Data source type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\DataSourceType")
     * @XmlAttribute
     */
    private $type;

    /**
     * Data source name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Constructor method for DataSourceSpecifier
     * @param DataSourceType $type
     * @param string $name
     * @param array $attrs
     * @return self
     */
    public function __construct(DataSourceType $type, string $name, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setType($type)
             ->setName($name);
    }

    /**
     * Gets data source type
     *
     * @return DataSourceType
     */
    public function getType(): DataSourceType
    {
        return $this->type;
    }

    /**
     * Sets data source type
     *
     * @param  DataSourceType $type
     * @return self
     */
    public function setType(DataSourceType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets data source name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets data source name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
