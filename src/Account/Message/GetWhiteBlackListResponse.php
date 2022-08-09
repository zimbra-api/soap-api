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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Account\Struct\WhiteListEntry;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetWhiteBlackListResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetWhiteBlackListResponse extends SoapResponse
{
    /**
     * White list
     * 
     * @Accessor(getter="getWhiteListEntries", setter="setWhiteListEntries")
     * @SerializedName("whiteList")
     * @Type("array<string>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="addr", namespace="urn:zimbraAccount")
     */
    private $whiteListEntries = [];

    /**
     * Black list
     * 
     * @Accessor(getter="getBlackListEntries", setter="setBlackListEntries")
     * @SerializedName("blackList")
     * @Type("array<string>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="addr", namespace="urn:zimbraAccount")
     */
    private $blackListEntries = [];

    /**
     * Constructor
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
     * Set whiteListEntries
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
     * Get whiteListEntries
     *
     * @return array
     */
    public function getWhiteListEntries(): array
    {
        return $this->whiteListEntries;
    }

    /**
     * Set blackListEntries
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
     * Get blackListEntries
     *
     * @return array
     */
    public function getBlackListEntries(): array
    {
        return $this->blackListEntries;
    }
}
