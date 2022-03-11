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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement};
use Zimbra\Soap\ResponseInterface;

/**
 * CheckHostnameResolveResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckHostnameResolveResponse implements ResponseInterface
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
     * Message
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $message;

    /**
     * Constructor method for CheckHostnameResolveResponse
     *
     * @param string $code
     * @param string $message
     * @return self
     */
    public function __construct(
        string $code,
        ?string $message = NULL
    )
    {
        $this->setCode($code);
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
