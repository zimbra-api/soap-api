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
 * EffectiveRightsTargetInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EffectiveRightsTargetInfo extends EffectiveRightsInfo
{
    /**
     * Target type
     * 
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\TargetType>")
     * @XmlAttribute
     * 
     * @var TargetType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\TargetType>')]
    #[XmlAttribute]
    private $type;

    /**
     * ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Constructor
     * 
     * @param  EffectiveAttrsInfo $setAttrs
     * @param  EffectiveAttrsInfo $getAttrs
     * @param  TargetType $type
     * @param  string $id
     * @param  string $name
     * @param  array $rights
     * @return self
     */
    public function __construct(
        EffectiveAttrsInfo $setAttrs,
        EffectiveAttrsInfo $getAttrs,
        ?TargetType $type = NULL,
        string $id = '',
        string $name = '',
        array $rights = []
    )
    {
        parent::__construct($setAttrs, $getAttrs, $rights);
        $this->setType($type ?? new TargetType('account'))
             ->setId($id)
             ->setName($name);
    }

    /**
     * Get type
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->type;
    }

    /**
     * Set type
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
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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
}
