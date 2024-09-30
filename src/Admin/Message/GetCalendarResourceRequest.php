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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Admin\Struct\CalendarResourceSelector;
use Zimbra\Common\Struct\{
    AttributeSelector,
    AttributeSelectorTrait,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * GetCalendarResourceRequest class
 * Get a calendar resource
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetCalendarResourceRequest extends SoapRequest implements
    AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Flag whether to apply Class of Service (COS)
     * 1 (true) [default]   COS rules apply and unset attrs on the calendar resource will get their value from the COS.
     * 0 (false)   only attributes directly set on the calendar resource will be returned
     *
     * @Accessor(getter="getApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getApplyCos", setter: "setApplyCos")]
    #[SerializedName("applyCos")]
    #[Type("bool")]
    #[XmlAttribute]
    private $applyCos;

    /**
     * Specify calendar resource
     *
     * @Accessor(getter="getCalResource", setter="setCalResource")
     * @SerializedName("calresource")
     * @Type("Zimbra\Admin\Struct\CalendarResourceSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var CalendarResourceSelector
     */
    #[Accessor(getter: "getCalResource", setter: "setCalResource")]
    #[SerializedName("calresource")]
    #[Type(CalendarResourceSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?CalendarResourceSelector $calResource;

    /**
     * Constructor
     *
     * @param  CalendarResourceSelector $calResource
     * @param  bool $applyCos
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?CalendarResourceSelector $calResource = null,
        ?bool $applyCos = null,
        ?string $attrs = null
    ) {
        $this->calResource = $calResource;
        if (null !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
        if (null !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Get applyCos
     *
     * @return bool
     */
    public function getApplyCos(): ?bool
    {
        return $this->applyCos;
    }

    /**
     * Set applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos(bool $applyCos): self
    {
        $this->applyCos = $applyCos;
        return $this;
    }

    /**
     * Get the calResource.
     *
     * @return CalendarResourceSelector
     */
    public function getCalResource(): ?CalendarResourceSelector
    {
        return $this->calResource;
    }

    /**
     * Set the calResource.
     *
     * @param  CalendarResourceSelector $calResource
     * @return self
     */
    public function setCalResource(CalendarResourceSelector $calResource): self
    {
        $this->calResource = $calResource;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetCalendarResourceEnvelope(
            new GetCalendarResourceBody($this)
        );
    }
}
