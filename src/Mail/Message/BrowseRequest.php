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
use Zimbra\Common\Enum\BrowseBy;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * BrowseRequest class
 * Browse
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BrowseRequest extends SoapRequest
{
    /**
     * Browse by setting - domains|attachments|objects
     * 
     * @Accessor(getter="getBrowseBy", setter="setBrowseBy")
     * @SerializedName("browseBy")
     * @Type("Enum<Zimbra\Common\Enum\BrowseBy>")
     * @XmlAttribute
     */
    private BrowseBy $browseBy;

    /**
     * Regex string.  Return only those results which match the specified regular expression
     * 
     * @Accessor(getter="getRegex", setter="setRegex")
     * @SerializedName("regex")
     * @Type("string")
     * @XmlAttribute
     */
    private $regex;

    /**
     * Return only a maximum number of entries as requested
     * 
     * @Accessor(getter="getMax", setter="setMax")
     * @SerializedName("maxToReturn")
     * @Type("integer")
     * @XmlAttribute
     */
    private $max;

    /**
     * Constructor
     *
     * @param  BrowseBy $browseBy
     * @param  string $regex
     * @param  int $max
     * @return self
     */
    public function __construct(
        ?BrowseBy $browseBy = NULL, ?string $regex = NULL, ?int $max = NULL
    )
    {
        $this->setBrowseBy($browseBy ?? new BrowseBy('domains'));
        if (NULL !== $regex) {
            $this->setRegex($regex);
        }
        if (NULL !== $max) {
            $this->setMax($max);
        }
    }

    /**
     * Get browseBy
     *
     * @return BrowseBy
     */
    public function getBrowseBy(): BrowseBy
    {
        return $this->browseBy;
    }

    /**
     * Set browseBy
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
     * Get regex
     *
     * @return string
     */
    public function getRegex(): ?string
    {
        return $this->regex;
    }

    /**
     * Set regex
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
     * Get max
     *
     * @return int
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * Set max
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new BrowseEnvelope(
            new BrowseBody($this)
        );
    }
}
