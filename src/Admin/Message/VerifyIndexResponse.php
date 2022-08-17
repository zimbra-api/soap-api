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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\SoapResponse;

/**
 * VerifyIndexResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VerifyIndexResponse extends SoapResponse
{
    /**
     * Result status of verification.  Valid values "true" and "false" (Not "1" and "0")
     * 
     * @Accessor(getter="isStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("bool")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     * 
     * @var bool
     */
    #[Accessor(getter: 'isStatus', setter: 'setStatus')]
    #[SerializedName(name: 'status')]
    #[Type(name: 'bool')]
    #[XmlElement(cdata: false,namespace: 'urn:zimbraAdmin')]
    private $status;

    /**
     * Verification output
     * 
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     * 
     * @var string
     */
    #[Accessor(getter: 'getMessage', setter: 'setMessage')]
    #[SerializedName(name: 'message')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false,namespace: 'urn:zimbraAdmin')]
    private $message;

    /**
     * Constructor
     *
     * @param bool $status
     * @param string $message
     * @return self
     */
    public function __construct(bool $status = FALSE, string $message = '')
    {
        $this->setStatus($status)
             ->setMessage($message);
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * Set status
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
     * Get message
     *
     * @return string
     */
    public function getMessage(): string
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
