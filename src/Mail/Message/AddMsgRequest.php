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
use Zimbra\Soap\Request;

/**
 * AddMsgRequest class
 * Add a message
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AddMsgRequest extends Request
{
    /**
     * If set, then do outgoing message filtering if the msg is being added to the Sent
     * folder and has been flagged as sent. Default is unset.
     * @Accessor(getter="getFilterSent", setter="setFilterSent")
     * @SerializedName("filterSent")
     * @Type("bool")
     * @XmlAttribute
     */
    private $filterSent;

    /**
     * Specification of the message to add
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\AddMsgSpec")
     * @XmlElement
     */
    private $msg;

    /**
     * Constructor method for AddMsgRequest
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
     * Sets msg
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
     * Gets msg
     *
     * @return AddMsgSpec
     */
    public function getMsg(): AddMsgSpec
    {
        return $this->msg;
    }

    /**
     * Sets filterSent
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
     * Gets filterSent
     *
     * @return bool
     */
    public function getFilterSent(): ?bool
    {
        return $this->filterSent;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AddMsgEnvelope)) {
            $this->envelope = new AddMsgEnvelope(
                new AddMsgBody($this)
            );
        }
    }
}
