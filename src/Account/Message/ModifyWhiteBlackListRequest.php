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
use Zimbra\Common\Struct\OpValue;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyWhiteBlackListRequest class
 * Modify the anti-spam WhiteList and BlackList addresses
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyWhiteBlackListRequest extends SoapRequest
{
    /**
     * Modifications for WhiteList
     * @Accessor(getter="getWhiteListEntries", setter="setWhiteListEntries")
     * @SerializedName("whiteList")
     * @Type("array<Zimbra\Common\Struct\OpValue>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="addr", namespace="urn:zimbraAccount")
     */
    private $whiteListEntries = [];

    /**
     * Modifications for BlackList
     * @Accessor(getter="getBlackListEntries", setter="setBlackListEntries")
     * @SerializedName("blackList")
     * @Type("array<Zimbra\Common\Struct\OpValue>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="addr", namespace="urn:zimbraAccount")
     */
    private $blackListEntries = [];

    /**
     * Constructor method for ModifyWhiteBlackListRequest
     *
     * @param  array $whiteListEntries
     * @param  array $blackListEntries
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
     * Add a whiteListEntry
     *
     * @param  OpValue $whiteListEntry
     * @return self
     */
    public function addWhiteListEntry(OpValue $whiteListEntry): self
    {
        $this->whiteListEntries[] = $whiteListEntry;
        return $this;
    }

    /**
     * Set whiteListEntries
     *
     * @param  array $entries
     * @return self
     */
    public function setWhiteListEntries(array $entries): self
    {
        $this->whiteListEntries = array_filter($entries, static fn ($entry) => $entry instanceof OpValue);
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
     * Add a blackListEntry
     *
     * @param  OpValue $blackListEntry
     * @return self
     */
    public function addBlackListEntry(OpValue $blackListEntry): self
    {
        $this->blackListEntries[] = $blackListEntry;
        return $this;
    }

    /**
     * Set blackListEntries
     *
     * @param  array $entries
     * @return self
     */
    public function setBlackListEntries(array $entries): self
    {
        $this->blackListEntries = array_filter($entries, static fn ($entry) => $entry instanceof OpValue);
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

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyWhiteBlackListEnvelope(
            new ModifyWhiteBlackListBody($this)
        );
    }
}
