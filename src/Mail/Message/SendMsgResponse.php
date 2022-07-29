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
use Zimbra\Mail\Struct\MsgWithGroupInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * SendMsgResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SendMsgResponse implements SoapResponseInterface
{
    /**
     * Message Information about the saved copy of the sent message.
     * Note, "m" element will have no content if the message was not saved.
     * Note, Full information will be provided if fetchSavedMsg was specified in the request, otherwise
     * only the message id will be returned.
     * 
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MsgWithGroupInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MsgWithGroupInfo $msg = NULL;

    /**
     * Constructor method for SendMsgResponse
     *
     * @param MsgWithGroupInfo $msg
     * @return self
     */
    public function __construct(?MsgWithGroupInfo $msg = NULL)
    {
        if ($msg instanceof MsgWithGroupInfo) {
            $this->setMsg($msg);
        }
    }

    /**
     * Get the msg.
     *
     * @return MsgWithGroupInfo
     */
    public function getMsg(): ?MsgWithGroupInfo
    {
        return $this->msg;
    }

    /**
     * Set the msg.
     *
     * @param  MsgWithGroupInfo $msg
     * @return self
     */
    public function setMsg(MsgWithGroupInfo $msg): self
    {
        $this->msg = $msg;
        return $this;
    }
}
