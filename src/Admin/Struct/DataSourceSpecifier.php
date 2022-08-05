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
use Zimbra\Common\Enum\DataSourceType;

/**
 * DataSourceSpecifier struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DataSourceSpecifier extends AdminAttrsImpl
{
    /**
     * Data source type
     * 
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\DataSourceType>")
     * @XmlAttribute
     */
    private DataSourceType $type;

    /**
     * Data source name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Constructor
     * 
     * @param DataSourceType $type
     * @param string $name
     * @param array $attrs
     * @return self
     */
    public function __construct(
        ?DataSourceType $type = NULL, string $name = '', array $attrs = []
    )
    {
        parent::__construct($attrs);
        $this->setType($type ?? DataSourceType::UNKNOWN())
             ->setName($name);
    }

    /**
     * Get data source type
     *
     * @return DataSourceType
     */
    public function getType(): DataSourceType
    {
        return $this->type;
    }

    /**
     * Set data source type
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
     * Get data source name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set data source name
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
