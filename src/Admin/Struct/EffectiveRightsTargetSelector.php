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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EffectiveRightsTargetSelector
{
    /**
     * Target type
     * 
     * @var TargetType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName('type')]
    #[XmlAttribute]
    private TargetType $type;

    /**
     * Target by
     * 
     * @var TargetBy
     */
    #[Accessor(getter: 'getBy', setter: 'setBy')]
    #[SerializedName('by')]
    #[XmlAttribute]
    private ?TargetBy $by;

    /**
     * The value
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
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
        $this->setType($type ?? TargetType::ACCOUNT);
        $this->by = $by;
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get type enum
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->type;
    }

    /**
     * Set type enum
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
     * Get by enum
     *
     * @return TargetBy
     */
    public function getBy(): ?TargetBy
    {
        return $this->by;
    }

    /**
     * Set by enum
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
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
