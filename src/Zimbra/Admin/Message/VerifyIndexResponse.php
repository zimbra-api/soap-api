<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source status.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessorOrder, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Soap\ResponseInterface;

/**
 * VerifyIndexResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @AccessorOrder("custom", custom = {"status", "message"})
 * @XmlRoot(name="VerifyIndexResponse")
 */
class VerifyIndexResponse implements ResponseInterface
{
    /**
     * Result status of verification.  Valid values "true" and "false" (Not "1" and "0")
     * @Accessor(getter="isStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("bool")
     * @XmlElement(cdata=false)
     */
    private $status;

    /**
     * Verification output
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $message;

    /**
     * Constructor method for VerifyIndexResponse
     * @param bool $status
     * @param string $message
     * @return self
     */
    public function __construct(bool $status, string $message)
    {
        $this->setStatus($status)
             ->setMessage($message);
    }

    /**
     * Gets status
     *
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  bool $status
     * @return self
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Gets message
     *
     * @return string
     */
    public function getMessage(): string
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
