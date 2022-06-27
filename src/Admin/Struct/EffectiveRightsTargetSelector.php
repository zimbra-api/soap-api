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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\{TargetType, TargetBy};

/**
 * EffectiveRightsTargetSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class EffectiveRightsTargetSelector
{
    /**
     * Target type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\TargetType")
     * @XmlAttribute
     */
    private TargetType $type;

    /**
     * Target by
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\TargetBy")
     * @XmlAttribute
     */
    private ?TargetBy $by = NULL;

    /**
     * The value
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for EffectiveRightsTargetSelector
     * 
     * @param TargetType $type
     * @param TargetBy   $by
     * @param string     $value
     * @return self
     */
    public function __construct(
        ?TargetType $type = NULL, ?TargetBy $by = NULL, ?string $value = NULL
    )
    {
        $this->setType($type ?? TargetType::ACCOUNT());
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
    public function getBy(): ?TargetBy
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
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
