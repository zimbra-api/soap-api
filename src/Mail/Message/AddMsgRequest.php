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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\AddMsgSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AddMsgRequest class
 * Add a message
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddMsgRequest extends SoapRequest
{
    /**
     * If set, then do outgoing message filtering if the msg is being added to the Sent
     * folder and has been flagged as sent. Default is unset.
     * 
     * @Accessor(getter="getFilterSent", setter="setFilterSent")
     * @SerializedName("filterSent")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getFilterSent', setter: 'setFilterSent')]
    #[SerializedName('filterSent')]
    #[Type('bool')]
    #[XmlAttribute]
    private $filterSent;

    /**
     * Specification of the message to add
     * 
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\AddMsgSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var AddMsgSpec
     */
    #[Accessor(getter: "getMsg", setter: "setMsg")]
    #[SerializedName('m')]
    #[Type(AddMsgSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private AddMsgSpec $msg;

    /**
     * Constructor
     *
     * @param  AddMsgSpec $msg
     * @param  bool $filterSent
     * @return self
     */
    public function __construct(AddMsgSpec $msg, ?bool $filterSent = NULL)
    {
        $this->setMsg($msg);
        if (NULL !== $filterSent) {
            $this->setFilterSent($filterSent);
        }
    }

    /**
     * Set msg
     *
     * @param  AddMsgSpec $msg
     * @return self
     */
    public function setMsg(AddMsgSpec $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Get msg
     *
     * @return AddMsgSpec
     */
    public function getMsg(): AddMsgSpec
    {
        return $this->msg;
    }

    /**
     * Set filterSent
     *
     * @param  bool $filterSent
     * @return self
     */
    public function setFilterSent(bool $filterSent): self
    {
        $this->filterSent = $filterSent;
        return $this;
    }

    /**
     * Get filterSent
     *
     * @return bool
     */
    public function getFilterSent(): ?bool
    {
        return $this->filterSent;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AddMsgEnvelope(
            new AddMsgBody($this)
        );
    }
}
