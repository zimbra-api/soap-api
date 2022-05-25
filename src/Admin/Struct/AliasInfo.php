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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AliasInfo extends AdminObjectInfo
{
    /**
     * Target name
     * @Accessor(getter="getTargetName", setter="setTargetName")
     * @SerializedName("targetName")
     * @Type("string")
     * @XmlAttribute
     */
    private $targetName;

    /**
     * Target type
     * @Accessor(getter="getTargetTyoe", setter="setTargetTyoe")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\TargetType")
     * @XmlAttribute
     */
    private ?TargetType $targetType = NULL;

    /**
     * Constructor method for AliasInfo
     * 
     * @param  string $name
     * @param  string $id
     * @param  string $targetName
     * @param  TargetType $targetType
     * @param  array  $attrs
     * @return self
     */
    public function __construct(
        string $name, string $id, string $targetName, ?TargetType $targetType = NULL, array $attrs = []
    )
    {
        parent::__construct($name, $id, $attrs);
        $this->setTargetName($targetName);
        if ($targetType instanceof TargetType) {
            $this->setTargetTyoe($targetType);
        }
    }

    /**
     * Gets target name
     *
     * @return string
     */
    public function getTargetName(): string
    {
        return $this->targetName;
    }

    /**
     * Sets target name
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
     * Gets target type
     *
     * @return TargetType
     */
    public function getTargetTyoe(): ?TargetType
    {
        return $this->targetType;
    }

    /**
     * Sets target type
     *
     * @param  TargetType $targetType
     * @return self
     */
    public function setTargetTyoe(TargetType $targetType): self
    {
        $this->targetType = $targetType;
        return $this;
    }
}
