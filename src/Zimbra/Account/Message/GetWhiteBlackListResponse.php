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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
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
 * @AccessType("public_method")
 * @XmlRoot(name="GetWhiteBlackListResponse")
 */
class GetWhiteBlackListResponse implements ResponseInterface
{
    /**
     * White list
     * 
     * @Accessor(getter="getWhiteListEntries", setter="setWhiteListEntries")
     * @SerializedName("whiteList")
     * @Type("array<string>")
     * @XmlList(inline = false, entry = "addr")
     */
    private $whiteListEntries;

    /**
     * Black list
     * 
     * @Accessor(getter="getBlackListEntries", setter="setBlackListEntries")
     * @SerializedName("blackList")
     * @Type("array<string>")
     * @XmlList(inline = false, entry = "addr")
     */
    private $blackListEntries;

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
     * @param  string $whiteListEntry
     * @return self
     */
    public function addWhiteListEntry(string $whiteListEntry): self
    {
        $whiteListEntry = trim($whiteListEntry);
        if (!in_array($whiteListEntry, $this->whiteListEntries)) {
            $this->whiteListEntries[] = $whiteListEntry;
        }
        return $this;
    }

    /**
     * Sets whiteListEntries
     *
     * @param  array $whiteListEntries
     * @return self
     */
    public function setWhiteListEntries(array $whiteListEntries): self
    {
        $this->whiteListEntries = [];
        foreach ($whiteListEntries as $whiteListEntry) {
            $this->addWhiteListEntry($whiteListEntry);
        }
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
     * @param  string $blackListEntry
     * @return self
     */
    public function addBlackListEntry(string $blackListEntry): self
    {
        $blackListEntry = trim($blackListEntry);
        if (!in_array($blackListEntry, $this->blackListEntries)) {
            $this->blackListEntries[] = $blackListEntry;
        }
        return $this;
    }

    /**
     * Sets blackListEntries
     *
     * @param  array $blackListEntries
     * @return self
     */
    public function setBlackListEntries(array $blackListEntries): self
    {
        $this->blackListEntries = [];
        foreach ($blackListEntries as $blackListEntry) {
            $this->addBlackListEntry($blackListEntry);
        }
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
