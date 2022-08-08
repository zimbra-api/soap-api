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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetZimletRequest class
 * Get Zimlet
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetZimletRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Zimlet selector
     * 
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Common\Struct\NamedElement")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var NamedElement
     */
    private $zimlet;

    /**
     * Constructor
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
     * Get the zimlet.
     *
     * @return NamedElement
     */
    public function getZimlet(): NamedElement
    {
        return $this->zimlet;
    }

    /**
     * Set the zimlet.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetZimletEnvelope(
            new GetZimletBody($this)
        );
    }
}
