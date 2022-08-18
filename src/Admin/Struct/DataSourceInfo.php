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
 * DataSourceInfo struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DataSourceInfo extends AdminAttrsImpl
{
    /**
     * Data source name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Data source id
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Data source type
     * 
     * @var DataSourceType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\DataSourceType>')]
    #[XmlAttribute]
    private $type;

    /**
     * Constructor
     * 
     * @param string $name
     * @param string $id
     * @param DataSourceType $type 
     * @param array $attrs Attributes
     * @return self
     */
    public function __construct(
        string $name = '', string $id = '', ?DataSourceType $type = NULL, array $attrs = []
    )
    {
        parent::__construct($attrs);
        $this->setName($name)
             ->setId($id)
             ->setType($type ?? DataSourceType::UNKNOWN);
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

    /**
     * Get data source id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set data source id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
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
}
