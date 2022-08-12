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
use Zimbra\Common\Enum\TargetType;

/**
 * AliasInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AliasInfo extends AdminObjectInfo
{
    /**
     * Target name
     * 
     * @Accessor(getter="getTargetName", setter="setTargetName")
     * @SerializedName("targetName")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getTargetName', setter: 'setTargetName')]
    #[SerializedName(name: 'targetName')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $targetName;

    /**
     * Target type
     * 
     * @Accessor(getter="getTargetType", setter="setTargetType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\TargetType>")
     * @XmlAttribute
     * 
     * @var TargetType
     */
    #[Accessor(getter: 'getTargetType', setter: 'setTargetType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\TargetType>')]
    #[XmlAttribute]
    private $targetType;

    /**
     * Constructor
     * 
     * @param  string $name
     * @param  string $id
     * @param  string $targetName
     * @param  TargetType $targetType
     * @param  array  $attrs
     * @return self
     */
    public function __construct(
        string $name = '',
        string $id = '',
        string $targetName = '',
        ?TargetType $targetType = NULL,
        array $attrs = []
    )
    {
        parent::__construct($name, $id, $attrs);
        $this->setTargetName($targetName);
        if ($targetType instanceof TargetType) {
            $this->setTargetType($targetType);
        }
    }

    /**
     * Get target name
     *
     * @return string
     */
    public function getTargetName(): string
    {
        return $this->targetName;
    }

    /**
     * Set target name
     *
     * @param  string $targetName
     * @return self
     */
    public function setTargetName(string $targetName): self
    {
        $this->targetName = $targetName;
        return $this;
    }

    /**
     * Get target type
     *
     * @return TargetType
     */
    public function getTargetType(): ?TargetType
    {
        return $this->targetType;
    }

    /**
     * Set target type
     *
     * @param  TargetType $targetType
     * @return self
     */
    public function setTargetType(TargetType $targetType): self
    {
        $this->targetType = $targetType;
        return $this;
    }
}
