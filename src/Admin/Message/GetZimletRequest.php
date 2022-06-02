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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{AttributeSelector, AttributeSelectorTrait, NamedElement};
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GetZimletRequest class
 * Get Zimlet
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetZimletRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Zimlet selector
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Common\Struct\NamedElement")
     * @XmlElement
     */
    private NamedElement $zimlet;

    /**
     * Constructor method for GetZimletRequest
     * 
     * @param  NamedElement $zimlet
     * @param  string $attrs
     * @return self
     */
    public function __construct(NamedElement $zimlet, ?string $attrs = NULL)
    {
        $this->setZimlet($zimlet);
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets the zimlet.
     *
     * @return NamedElement
     */
    public function getZimlet(): NamedElement
    {
        return $this->zimlet;
    }

    /**
     * Sets the zimlet.
     *
     * @param  NamedElement $zimlet
     * @return self
     */
    public function setZimlet(NamedElement $zimlet): self
    {
        $this->zimlet = $zimlet;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetZimletEnvelope(
            new GetZimletBody($this)
        );
    }
}
