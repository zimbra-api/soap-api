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
    SerializedName,
    Type,
    XmlElement,
    XmlList
};
use Zimbra\Common\Struct\SoapResponse;

/**
 * CheckDomainMXRecordResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckDomainMXRecordResponse extends SoapResponse
{
    /**
     * MX Record entries
     *
     * @Accessor(getter="getEntries", setter="setEntries")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="entry", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getEntries", setter: "setEntries")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "entry", namespace: "urn:zimbraAdmin")]
    private $entries = [];

    /**
     * Code - Ok or Failed
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
     * Message associated with code="Failed"
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
     * @param array $entries
     * @param string $code
     * @param string $message
     * @return self
     */
    public function __construct(
        array $entries = [],
        string $code = "",
        ?string $message = null
    ) {
        $this->setEntries($entries)->setCode($code);
        if (null !== $message) {
            $this->setMessage($message);
        }
    }

    /**
     * Get MX Record entries
     *
     * @return array
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * Set MX Record entries
     *
     * @param  array $entries
     * @return self
     */
    public function setEntries(array $entries): self
    {
        $this->entries = array_unique(
            array_map(static fn($entry) => trim($entry), $entries)
        );
        return $this;
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
