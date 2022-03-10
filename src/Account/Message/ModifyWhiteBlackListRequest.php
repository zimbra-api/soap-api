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
use Zimbra\Struct\OpValue;
use Zimbra\Soap\Request;

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
class ModifyWhiteBlackListRequest extends Request
{
    /**
     * Modifications for WhiteList
     * @Accessor(getter="getWhiteListEntries", setter="setWhiteListEntries")
     * @SerializedName("whiteList")
     * @Type("array<Zimbra\Struct\OpValue>")
     * @XmlList(inline = false, entry = "addr")
     */
    private $whiteListEntries;

    /**
     * Modifications for BlackList
     * @Accessor(getter="getBlackListEntries", setter="setBlackListEntries")
     * @SerializedName("blackList")
     * @Type("array<Zimbra\Struct\OpValue>")
     * @XmlList(inline = false, entry = "addr")
     */
    private $blackListEntries;

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
     * @param  array $whiteListEntries
     * @return self
     */
    public function setWhiteListEntries(array $whiteListEntries): self
    {
        $this->whiteListEntries = [];
        foreach ($whiteListEntries as $whiteListEntry) {
            if ($whiteListEntry instanceof OpValue) {
                $this->whiteListEntries[] = $whiteListEntry;
            }
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
     * @param  array $blackListEntries
     * @return self
     */
    public function setBlackListEntries(array $blackListEntries): self
    {
        $this->blackListEntries = [];
        foreach ($blackListEntries as $blackListEntry) {
            if ($blackListEntry instanceof OpValue) {
                $this->blackListEntries[] = $blackListEntry;
            }
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

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyWhiteBlackListEnvelope)) {
            $this->envelope = new ModifyWhiteBlackListEnvelope(
                new ModifyWhiteBlackListBody($this)
            );
        }
    }
}
