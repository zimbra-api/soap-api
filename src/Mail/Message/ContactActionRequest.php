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
use Zimbra\Mail\Struct\ContactActionSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ContactActionRequest class
 * Contact Action
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactActionRequest extends SoapRequest
{
    /**
     * Contact action selector
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\ContactActionSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ContactActionSelector
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName(name: 'action')]
    #[Type(name: ContactActionSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $action;

    /**
     * Constructor
     *
     * @param  ContactActionSelector $action
     * @return self
     */
    public function __construct(ContactActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Get action
     *
     * @return ContactActionSelector
     */
    public function getAction(): ContactActionSelector
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  ContactActionSelector $action
     * @return self
     */
    public function setAction(ContactActionSelector $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ContactActionEnvelope(
            new ContactActionBody($this)
        );
    }
}
