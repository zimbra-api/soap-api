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
use Zimbra\Mail\Struct\DocumentActionSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DocumentActionRequest class
 * Document Action
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DocumentActionRequest extends SoapRequest
{
    /**
     * Document action selector
     * Document specific operations : watch|!watch|grant|!grant
     *
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\DocumentActionSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var DocumentActionSelector
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName("action")]
    #[Type(DocumentActionSelector::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private DocumentActionSelector $action;

    /**
     * Constructor
     *
     * @param  DocumentActionSelector $action
     * @return self
     */
    public function __construct(DocumentActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Get action
     *
     * @return DocumentActionSelector
     */
    public function getAction(): DocumentActionSelector
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  DocumentActionSelector $action
     * @return self
     */
    public function setAction(DocumentActionSelector $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DocumentActionEnvelope(new DocumentActionBody($this));
    }
}
