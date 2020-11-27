<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Request;

use Doctrine\Common\Annotations\AnnotationReader;
use JMS\Serializer\Annotation\{Accessor, AccessType, Exclude, Type, XmlMap, XmlRoot};
use Zimbra\Soap\{EnvelopeInterface, BatchRequestInterface, RequestInterface};

/**
 * Batch request class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="BatchRequest", namespace="urn:zimbra")
 */
class Batch implements BatchRequestInterface
{
    /**
     * @Accessor(getter="getRequests", setter="setRequests")
     * @Exclude
     * @XmlMap(keyAttribute = "requestId")
     * @Type("array<Zimbra\Soap\RequestInterface>")
     */
    private $requests;

    /**
     * @Accessor(getter="getOnError", setter="setOnError")
     * @Exclude
     * @Type("string")
     */
    private $onerror;

    /**
     * Batch request constructor
     * @param  array $requests
     * @return self
     */
    public function __construct(array $requests = [])
    {
        $this->setRequests($requests);
    }

    /**
     * Gets on error
     *
     * @return string
     */
    public function getOnError(): string
    {
        return $this->onerror;
    }

    /**
     * Sets on error
     *
     * @param  string $name
     * @return self
     */
    public function setOnError(string $onerror): self
    {
        $onerror = strtolower($onerror);
        if (!in_array($onerror, ['continue', 'stop'])) {
            $onerror = 'continue';
        }
        $this->onerror = $onerror;
        return $this;
    }

    /**
     * Add a request
     *
     * @param  RequestInterface $request
     * @return self
     */
    public function addRequest(RequestInterface $request): self
    {
        $this->requests[] = $request;
        return $this;
    }

    /**
     * Set requests
     *
     * @param  array $requests
     * @return Sequence
     */
    public function setRequests(array $requests): self
    {
        $this->requests = [];
        foreach ($requests as $request) {
            if ($request instanceof RequestInterface) {
                $this->requests[] = $request;
            }
        }
        return $this;
    }

    /**
     * Gets requests
     *
     * @return array
     */
    public function getRequests(): array
    {
        return $this->requests;
    }

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
    }
}
