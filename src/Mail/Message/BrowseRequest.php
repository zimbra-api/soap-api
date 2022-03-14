<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Enum\BrowseBy;
use Zimbra\Soap\Request;

/**
 * BrowseRequest class
 * Applies one or more filter rules to messages specified by a comma-separated ID list,
 * or returned by a search query.  One or the other can be specified, but not both.  Returns the list of ids of
 * existing messages that were affected.
 *
 * Note that redirect actions are ignored when applying filter rules to existing messages.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class BrowseRequest extends Request
{
    /**
     * Browse by setting - domains|attachments|objects
     * @Accessor(getter="getBrowseBy", setter="setBrowseBy")
     * @SerializedName("browseBy")
     * @Type("Zimbra\Enum\BrowseBy")
     * @XmlAttribute
     */
    private $browseBy;

    /**
     * Regex string.  Return only those results which match the specified regular expression
     * @Accessor(getter="getRegex", setter="setRegex")
     * @SerializedName("regex")
     * @Type("string")
     * @XmlAttribute
     */
    private $regex;

    /**
     * Return only a maximum number of entries as requested
     * @Accessor(getter="getMax", setter="setMax")
     * @SerializedName("maxToReturn")
     * @Type("integer")
     * @XmlAttribute
     */
    private $max;

    /**
     * Constructor method for BrowseRequest
     *
     * @param  BrowseBy $browseBy
     * @param  string $regex
     * @param  int $max
     * @return self
     */
    public function __construct(
        BrowseBy $browseBy,
        ?string $regex = NULL,
        ?int $max = NULL
    )
    {
        $this->setBrowseBy($browseBy);
        if (NULL !== $regex) {
            $this->setRegex($regex);
        }
        if (NULL !== $max) {
            $this->setMax($max);
        }
    }

    /**
     * Gets browseBy
     *
     * @return BrowseBy
     */
    public function getBrowseBy(): BrowseBy
    {
        return $this->browseBy;
    }

    /**
     * Sets browseBy
     *
     * @param  BrowseBy $browseBy
     * @return self
     */
    public function setBrowseBy(BrowseBy $browseBy): self
    {
        $this->browseBy = $browseBy;
        return $this;
    }

    /**
     * Gets regex
     *
     * @return string
     */
    public function getRegex(): ?string
    {
        return $this->regex;
    }

    /**
     * Sets regex
     *
     * @param  string $regex
     * @return self
     */
    public function setRegex(string $regex): self
    {
        $this->regex = $regex;
        return $this;
    }

    /**
     * Gets max
     *
     * @return int
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * Sets max
     *
     * @param  int $max
     * @return self
     */
    public function setMax(int $max): self
    {
        $this->max = $max;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof BrowseEnvelope)) {
            $this->envelope = new BrowseEnvelope(
                new BrowseBody($this)
            );
        }
    }
}
