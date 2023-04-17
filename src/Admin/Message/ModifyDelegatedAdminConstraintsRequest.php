<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyDelegatedAdminConstraintsRequest class
 * Modify constraint (zimbraConstraint) for delegated admin on global config or a COS
 * If constraints for an attribute already exists, it will be replaced by the new constraints.
 * If <constraint> is an empty element, constraints for the attribute will be removed. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyDelegatedAdminConstraintsRequest extends SoapRequest
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
     * ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Constaint attributes
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttrs', setter: 'setAttrs')]
    #[Type('array<Zimbra\Admin\Struct\ConstraintAttr>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraAdmin')]
    private $attrs = [];

    /**
     * Constructor
     * 
     * @param TargetType $type
     * @param string $id
     * @param string $name
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        ?TargetType $type = NULL, ?string $id = NULL, ?string $name = NULL, array $attrs = []
    )
    {
        $this->setType($type ?? TargetType::ACCOUNT)
             ->setAttrs($attrs);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
    }

    /**
     * Get the type.
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->type;
    }

    /**
     * Set the type
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
    public function getId(): ?string
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
     * Get the name.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name
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
     * Add an attr
     *
     * @param  ConstraintAttr $attr
     * @return self
     */
    public function addAttr(ConstraintAttr $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Set attribute sequence
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter(
            $attrs, static fn ($attr) => $attr instanceof ConstraintAttr
        );
        return $this;
    }

    /**
     * Get attribute sequence
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyDelegatedAdminConstraintsEnvelope(
            new ModifyDelegatedAdminConstraintsBody($this)
        );
    }
}
