<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, Type, XmlAttribute};

/**
 * Request class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
abstract class Request implements RequestInterface
{
    /**
     * @var EnvelopeInterface
     * @Exclude
     */
    protected $envelope;

    /**
     * Request id. Used with BatchRequestInterface
     * @Accessor(getter="getRequestId", setter="setRequestId")
     * @SerializedName("requestId")
     * @Type("string")
     * @XmlAttribute
     */
    protected $requestId;

    /**
     * Gets request id
     *
     * @return string
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * Sets request id
     *
     * @param  string $requestId
     * @return self
     */
    public function setRequestId(string $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        $this->envelopeInit();
        return $this->envelope;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    abstract protected function envelopeInit(): void;
}
