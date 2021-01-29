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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\RightType;

/**
 * ComboRightInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="right")
 */
class ComboRightInfo
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("n")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\RightType")
     * @XmlAttribute
     */
    private $type;

    /**
     * @Accessor(getter="getTargetType", setter="setTargetType")
     * @SerializedName("targetType")
     * @Type("string")
     * @XmlAttribute
     */
    private $targetType;

    /**
     * Constructor method for ComboRightInfo
     * @param  string $name
     * @return self
     */
    public function __construct(string $name, RightType $type, ?string $targetType = NULL)
    {
        $this->setName($name)
            ->setType($type);
        if (NULL !== $targetType) {
            $this->setTargetType($targetType);
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
     * Gets type enum
     *
     * @return RightType
     */
    public function getType(): RightType
    {
        return $this->type;
    }

    /**
     * Sets type enum
     *
     * @param  RightType $type
     * @return self
     */
    public function setType(RightType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets targetType
     *
     * @return string
     */
    public function getTargetType(): ?string
    {
        return $this->targetType;
    }

    /**
     * Sets targetType
     *
     * @param  string $targetType
     * @return self
     */
    public function setTargetType(string $targetType): self
    {
        $this->targetType = $targetType;
        return $this;
    }
}
