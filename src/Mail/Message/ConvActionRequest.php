<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\ConvActionSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ConvActionRequest class
 * Conv Action
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConvActionRequest extends SoapRequest
{
    /**
     * Conversation action selector
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ConvActionSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ConvActionSelector
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName('action')]
    #[Type(ConvActionSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ConvActionSelector $action;

    /**
     * Constructor
     *
     * @param  ConvActionSelector $action
     * @return self
     */
    public function __construct(ConvActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Get action
     *
     * @return ConvActionSelector
     */
    public function getAction(): ConvActionSelector
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  ConvActionSelector $action
     * @return self
     */
    public function setAction(ConvActionSelector $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ConvActionEnvelope(
            new ConvActionBody($this)
        );
    }
}
