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

use JMS\Serializer\Annotation\{Accessor, AccessorOrder, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Soap\ResponseInterface;

/**
 * CheckAuthConfigResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @AccessorOrder("custom", custom = {"code", "message", "bindDn"})
 * @XmlRoot(name="CheckAuthConfigResponse")
 */
class CheckAuthConfigResponse implements ResponseInterface
{
    /**
     * Code
     * @Accessor(getter="getCode", setter="setCode")
     * @SerializedName("code")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $code;

    /**
     * DN computed from supplied bind DN and name
     * @Accessor(getter="getBindDn", setter="setBindDn")
     * @SerializedName("bindDn")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $bindDn;

    /**
     * Message
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $message;

    /**
     * Constructor method for CheckAuthConfigResponse
     *
     * @param string $code
     * @param string $bindDn
     * @param string $message
     * @return self
     */
    public function __construct(
        string $code,
        string $bindDn,
        ?string $message = NULL
    )
    {
        $this->setCode($code)
             ->setBindDn($bindDn);
        if (NULL !== $message) {
            $this->setMessage($message);
        }
    }

    /**
     * Gets code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Sets code
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
     * Gets bind dn
     *
     * @return string
     */
    public function getBindDn(): string
    {
        return $this->bindDn;
    }

    /**
     * Sets bind dn
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
     * Gets message
     *
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Sets message
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
