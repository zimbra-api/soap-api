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

use JMS\Serializer\Annotation\{
    Accessor,
    AccessType,
    SerializedName,
    Type,
    XmlElement
};
use Zimbra\Common\Struct\SoapResponse;

/**
 * CheckAuthConfigResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckAuthConfigResponse extends SoapResponse
{
    /**
     * Code
     *
     * @Accessor(getter="getCode", setter="setCode")
     * @SerializedName("code")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     *
     * @var string
     */
    #[Accessor(getter: "getCode", setter: "setCode")]
    #[SerializedName("code")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $code;

    /**
     * DN computed from supplied bind DN and name
     *
     * @Accessor(getter="getBindDn", setter="setBindDn")
     * @SerializedName("bindDn")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     *
     * @var string
     */
    #[Accessor(getter: "getBindDn", setter: "setBindDn")]
    #[SerializedName("bindDn")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $bindDn;

    /**
     * Message
     *
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     *
     * @var string
     */
    #[Accessor(getter: "getMessage", setter: "setMessage")]
    #[SerializedName("message")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $message;

    /**
     * Constructor
     *
     * @param string $code
     * @param string $bindDn
     * @param string $message
     * @return self
     */
    public function __construct(
        string $code = "",
        string $bindDn = "",
        ?string $message = null
    ) {
        $this->setCode($code)->setBindDn($bindDn);
        if (null !== $message) {
            $this->setMessage($message);
        }
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param  string $code
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get bind dn
     *
     * @return string
     */
    public function getBindDn(): string
    {
        return $this->bindDn;
    }

    /**
     * Set bind dn
     *
     * @param  string $bindDn
     * @return self
     */
    public function setBindDn(string $bindDn): self
    {
        $this->bindDn = $bindDn;
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
