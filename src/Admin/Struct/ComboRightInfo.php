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
use Zimbra\Common\Enum\RightType;

/**
 * ComboRightInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ComboRightInfo
{
    /**
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'n')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * @var RightType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\RightType>')]
    #[XmlAttribute]
    private $type;

    /**
     * @var string
     */
    #[Accessor(getter: 'getTargetType', setter: 'setTargetType')]
    #[SerializedName(name: 'targetType')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $targetType;

    /**
     * Constructor
     * 
     * @param  string $name
     * @param  RightType $type
     * @param  string $targetType
     * @return self
     */
    public function __construct(
        string $name = '', ?RightType $type = NULL, ?string $targetType = NULL
    )
    {
        $this->setName($name)
             ->setType($type ?? new RightType('preset'));
        if (NULL !== $targetType) {
            $this->setTargetType($targetType);
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get type enum
     *
     * @return RightType
     */
    public function getType(): RightType
    {
        return $this->type;
    }

    /**
     * Set type enum
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
     * Get targetType
     *
     * @return string
     */
    public function getTargetType(): ?string
    {
        return $this->targetType;
    }

    /**
     * Set targetType
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
