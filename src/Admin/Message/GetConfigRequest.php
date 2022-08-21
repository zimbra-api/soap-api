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
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetConfigRequest class
 * Get Config request
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetConfigRequest extends SoapRequest
{
    /**
     * Attribute
     * 
     * @Accessor(getter="getAttr", setter="setAttr")
     * @SerializedName("a")
     * @Type("Zimbra\Admin\Struct\Attr")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var Attr
     */
    #[Accessor(getter: 'getAttr', setter: 'setAttr')]
    #[SerializedName('a')]
    #[Type(Attr::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?Attr $attr;

    /**
     * Constructor
     * 
     * @param  Attr $attr
     * @return self
     */
    public function __construct(?Attr $attr = NULL)
    {
        $this->attr = $attr;
    }

    /**
     * Get the attr.
     *
     * @return Attr
     */
    public function getAttr(): ?Attr
    {
        return $this->attr;
    }

    /**
     * Set the attr.
     *
     * @param  Attr $attr
     * @return self
     */
    public function setAttr(Attr $attr): self
    {
        $this->attr = $attr;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetConfigEnvelope(
            new GetConfigBody($this)
        );
    }
}
