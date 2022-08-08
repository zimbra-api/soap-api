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
use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetDelegatedAdminConstraintsRequest class
 * Get constraints (zimbraConstraint) for delegated admin on global config or a COS
 * none or several attributes can be specified for which constraints are to be returned.
 * If no attribute is specified, all constraints on the global config/cos will be returned.
 * If there is no constraint for a requested attribute, <a> element for the attribute will not appear in the response.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDelegatedAdminConstraintsRequest extends SoapRequest
{
    /**
     * Target Type
     * 
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\TargetType>")
     * @XmlAttribute
     * @var TargetType
     */
    private $type;

    /**
     * ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Attrs
     * 
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAdmin")
     */
    private $attrs = [];

    /**
     * Constructor
     * 
     * @param  TargetType $type
     * @param  string $id
     * @param  string $name
     * @param  array $attrs
     * @return self
     */
    public function __construct(
        ?TargetType $type = NULL, ?string $id = NULL, ?string $name = NULL, array $attrs = []
    )
    {
        $this->setType($type ?? new TargetType('account'))
             ->setAttrs($attrs);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
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
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
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
     * Get attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Set attrs
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter($attrs, static fn ($attr) => $attr instanceof NamedElement);
        return $this;
    }

    /**
     * Add an attr
     *
     * @param  NamedElement $attr
     * @return self
     */
    public function addAttr(NamedElement $attr): self
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetDelegatedAdminConstraintsEnvelope(
            new GetDelegatedAdminConstraintsBody($this)
        );
    }
}
