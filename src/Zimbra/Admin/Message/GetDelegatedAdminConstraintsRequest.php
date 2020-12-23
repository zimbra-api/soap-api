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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Enum\TargetType;
use Zimbra\Soap\Request;
use Zimbra\Struct\NamedElement;

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetDelegatedAdminConstraintsRequest")
 */
class GetDelegatedAdminConstraintsRequest extends Request
{
    /**
     * Target Type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\TargetType")
     * @XmlAttribute
     */
    private $type;

    /**
     * ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Attrs
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("a")
     * @Type("array<Zimbra\Struct\NamedElement>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attrs;

    /**
     * Constructor method for GetDelegatedAdminConstraintsRequest
     * 
     * @param  TargetType $type
     * @param  string $id
     * @param  string $name
     * @param  array $attrs
     * @return self
     */
    public function __construct(
        TargetType $type, ?string $id = NULL, ?string $name = NULL, array $attrs = []
    )
    {
        $this->setType($type)
            ->setAttrs($attrs);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
    }

    /**
     * Gets type
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->type;
    }

    /**
     * Sets type
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
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Gets attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Sets attrs
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof NamedElement) {
                $this->attrs[] = $attr;
            }
        }
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetDelegatedAdminConstraintsEnvelope)) {
            $this->envelope = new GetDelegatedAdminConstraintsEnvelope(
                new GetDelegatedAdminConstraintsBody($this)
            );
        }
    }
}
