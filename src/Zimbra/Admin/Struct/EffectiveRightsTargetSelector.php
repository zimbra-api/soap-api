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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};
use Zimbra\Enum\{TargetType, TargetBy};

/**
 * EffectiveRightsTargetSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="target")
 */
class EffectiveRightsTargetSelector
{
    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\TargetType")
     * @XmlAttribute
     */
    private $type;

    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Enum\TargetBy")
     * @XmlAttribute
     */
    private $by;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for EffectiveRightsTargetSelector
     * @param TargetType $type Target type
     * @param TargetBy $by Target by
     * @param string $value The value
     * @return self
     */
    public function __construct(TargetType $type, TargetBy $by = NULL, $value = NULL)
    {
        $this->setType($type);
        if (NULL !== $by) {
            $this->setBy($by);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets type enum
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->type;
    }

    /**
     * Sets type enum
     *
     * @param  TargetType $type
     * @return self
     */
    public function setType(TargetType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets by enum
     *
     * @return TargetBy
     */
    public function getBy(): TargetBy
    {
        return $this->by;
    }

    /**
     * Sets by enum
     *
     * @param  TargetBy $by
     * @return self
     */
    public function setBy(TargetBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value): self
    {
        $this->value = trim($value);
        return $this;
    }
}
