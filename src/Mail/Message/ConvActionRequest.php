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
use Zimbra\Common\Soap\{SoapEnvelopeInterface, SoapRequest};

/**
 * ConvActionRequest class
 * Conv Action
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ConvActionRequest extends SoapRequest
{
    /**
     * Conversation action selector
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ConvActionSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ConvActionSelector $action;

    /**
     * Constructor method for ConvActionRequest
     *
     * @param  ConvActionSelector $action
     * @return self
     */
    public function __construct(ConvActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Gets action
     *
     * @return ConvActionSelector
     */
    public function getAction(): ConvActionSelector
    {
        return $this->action;
    }

    /**
     * Sets action
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
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ConvActionEnvelope(
            new ConvActionBody($this)
        );
    }
}
