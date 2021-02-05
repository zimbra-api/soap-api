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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\CalendarResourceSelector;
use Zimbra\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Soap\Request;

/**
 * GetCalendarResourceRequest class
 * Get a calendar resource
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetCalendarResourceRequest")
 */
class GetCalendarResourceRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Flag whether to apply Class of Service (COS)
     * 1 (true) [default]   COS rules apply and unset attrs on the calendar resource will get their value from the COS. 
     * 0 (false)   only attributes directly set on the calendar resource will be returned
     * @Accessor(getter="getApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyCos;

    /**
     * Specify calendar resource
     * @Accessor(getter="getCalResource", setter="setCalResource")
     * @SerializedName("calresource")
     * @Type("Zimbra\Admin\Struct\CalendarResourceSelector")
     * @XmlElement
     */
    private $calResource;

    /**
     * Constructor method for GetCalendarResourceRequest
     * 
     * @param  CalendarResourceSelector $calResource
     * @param  bool $applyCos
     * @param  string $attrs
     * @return self
     */
    public function __construct(?CalendarResourceSelector $calResource = NULL, ?bool $applyCos = NULL, ?string $attrs = NULL)
    {
        if ($calResource instanceof CalendarResourceSelector) {
            $this->setCalResource($calResource);
        }
        if (NULL !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets applyCos
     *
     * @return bool
     */
    public function getApplyCos(): ?bool
    {
        return $this->applyCos;
    }

    /**
     * Sets applyCos
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
     * Gets the calResource.
     *
     * @return CalendarResourceSelector
     */
    public function getCalResource(): ?CalendarResourceSelector
    {
        return $this->calResource;
    }

    /**
     * Sets the calResource.
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetCalendarResourceEnvelope)) {
            $this->envelope = new GetCalendarResourceEnvelope(
                new GetCalendarResourceBody($this)
            );
        }
    }
}