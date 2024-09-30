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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetMsgResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMsgResponse extends SoapResponse
{
    /**
     * Message information
     *
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MsgWithGroupInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var MsgWithGroupInfo
     */
    #[Accessor(getter: "getMsg", setter: "setMsg")]
    #[SerializedName("m")]
    #[Type(MsgWithGroupInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?MsgWithGroupInfo $msg;

    /**
     * Constructor
     *
     * @param  MsgWithGroupInfo $msg
     * @return self
     */
    public function __construct(?MsgWithGroupInfo $msg = null)
    {
        $this->msg = $msg;
    }

    /**
     * Get msg
     *
     * @return MsgWithGroupInfo
     */
    public function getMsg(): ?MsgWithGroupInfo
    {
        return $this->msg;
    }

    /**
     * Set msg
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
