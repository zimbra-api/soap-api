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

use JMS\Serializer\Annotation\{Accessor, AccessorOrder, AccessType, SerializedName, Type, XmlElement, XmlList, XmlRoot};
use Zimbra\Soap\ResponseInterface;

/**
 * CheckDomainMXRecordResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @AccessorOrder("custom", custom = {"entries", "code", "message"})
 * @XmlRoot(name="CheckDomainMXRecordResponse")
 */
class CheckDomainMXRecordResponse implements ResponseInterface
{

    /**
     * MX Record entries
     * @Accessor(getter="getEntries", setter="setEntries")
     * @SerializedName("entry")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "entry")
     */
    private $entries;

    /**
     * Code - Ok or Failed
     * @Accessor(getter="getCode", setter="setCode")
     * @SerializedName("code")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $code;

    /**
     * Message associated with code="Failed"
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $message;

    /**
     * Constructor method for CheckDomainMXRecordResponse
     * @param array $entries
     * @param string $code
     * @param string $message
     * @return self
     */
    public function __construct(
        array $entries,
        $code,
        $message = NULL
    )
    {
        $this->setEntries($entries)
             ->setCode($code);
        if (NULL !== $message) {
            $this->setMessage($message);
        }
    }

    /**
     * Add a MX Record entry
     *
     * @param  string $entry
     * @return self
     */
    public function addEntry($entry): self
    {
        $entry = trim($entry);
        if (!empty($entry) && !in_array($entry, $this->entries)) {
            $this->entries[] = $entry;
        }
        return $this;
    }

    /**
     * Gets MX Record entries
     *
     * @return array
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * Sets MX Record entries
     *
     * @param  array $entries
     * @return self
     */
    public function setEntries(array $entries): self
    {
        $this->entries = [];
        foreach ($entries as $entry) {
            $this->addEntry($entry);
        }
        return $this;
    }

    /**
     * Gets code
     *
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Sets code
     *
     * @param  string $code
     * @return self
     */
    public function setCode($code): self
    {
        $this->code = trim($code);
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
    public function setMessage($message): self
    {
        $this->message = trim($message);
        return $this;
    }
}
