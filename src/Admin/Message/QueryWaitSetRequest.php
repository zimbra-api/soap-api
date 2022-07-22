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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * QueryWaitSetRequest class
 * Query WaitSet
 * This API dumps the internal state of all active waitsets.
 * It is intended for debugging use only and should not be used for production uses.
 * This API is not guaranteed to be stable between releases in any way and might be removed without warning.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class QueryWaitSetRequest extends Request
{
    /**
     * WaitSet ID
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * Constructor method for QueryWaitSetRequest
     *
     * @param  string $waitSetId
     * @return self
     */
    public function __construct(?string $waitSetId = NULL)
    {
        if (NULL !== $waitSetId) {
            $this->setWaitSetId($waitSetId);
        }
    }

    /**
     * Gets waitSetId
     *
     * @return string
     */
    public function getWaitSetId(): ?string
    {
        return $this->waitSetId;
    }

    /**
     * Sets waitSetId
     *
     * @param  string $waitSetId
     * @return self
     */
    public function setWaitSetId(string $waitSetId): self
    {
        $this->waitSetId = $waitSetId;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new QueryWaitSetEnvelope(
            new QueryWaitSetBody($this)
        );
    }
}
