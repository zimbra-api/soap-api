<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Account\Struct\WhiteListEntry;
use Zimbra\Soap\ResponseInterface;

/**
 * GetWhiteBlackListResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetWhiteBlackListResponse implements ResponseInterface
{
    /**
     * White list
     * 
     * @Accessor(getter="getWhiteListEntries", setter="setWhiteListEntries")
     * @SerializedName("whiteList")
     * @Type("array<string>")
     * @XmlList(inline=false, entry="addr", namespace="urn:zimbraAccount")
     */
    private $whiteListEntries = [];

    /**
     * Black list
     * 
     * @Accessor(getter="getBlackListEntries", setter="setBlackListEntries")
     * @SerializedName("blackList")
     * @Type("array<string>")
     * @XmlList(inline=false, entry="addr", namespace="urn:zimbraAccount")
     */
    private $blackListEntries = [];

    /**
     * Constructor method for GetWhiteBlackListResponse
     *
     * @param array $whiteListEntries
     * @param array $blackListEntries
     * @return self
     */
    public function __construct(
        array $whiteListEntries = [], array $blackListEntries = []
    )
    {
        $this->setWhiteListEntries($whiteListEntries)
             ->setBlackListEntries($blackListEntries);
    }

    /**
     * Add whiteListEntry
     *
     * @param  string $entry
     * @return self
     */
    public function addWhiteListEntry(string $entry): self
    {
        $entry = trim($entry);
        if (!in_array($entry, $this->whiteListEntries)) {
            $this->whiteListEntries[] = $entry;
        }
        return $this;
    }

    /**
     * Sets whiteListEntries
     *
     * @param  array $entries
     * @return self
     */
    public function setWhiteListEntries(array $entries): self
    {
        $this->whiteListEntries = array_unique(array_map(static fn ($entry) => trim($entry), $entries));
        return $this;
    }

    /**
     * Gets whiteListEntries
     *
     * @return array
     */
    public function getWhiteListEntries(): array
    {
        return $this->whiteListEntries;
    }

    /**
     * Add blackListEntry
     *
     * @param  string $entry
     * @return self
     */
    public function addBlackListEntry(string $entry): self
    {
        $entry = trim($entry);
        if (!in_array($entry, $this->blackListEntries)) {
            $this->blackListEntries[] = $entry;
        }
        return $this;
    }

    /**
     * Sets blackListEntries
     *
     * @param  array $entries
     * @return self
     */
    public function setBlackListEntries(array $entries): self
    {
        $this->blackListEntries = array_unique(array_map(static fn ($entry) => trim($entry), $entries));
        return $this;
    }

    /**
     * Gets blackListEntries
     *
     * @return array
     */
    public function getBlackListEntries(): array
    {
        return $this->blackListEntries;
    }
}
