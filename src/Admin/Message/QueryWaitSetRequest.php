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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class QueryWaitSetRequest extends SoapRequest
{
    /**
     * WaitSet ID
     *
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getWaitSetId", setter: "setWaitSetId")]
    #[SerializedName("waitSet")]
    #[Type("string")]
    #[XmlAttribute]
    private $waitSetId;

    /**
     * Constructor
     *
     * @param  string $waitSetId
     * @return self
     */
    public function __construct(?string $waitSetId = null)
    {
        if (null !== $waitSetId) {
            $this->setWaitSetId($waitSetId);
        }
    }

    /**
     * Get waitSetId
     *
     * @return string
     */
    public function getWaitSetId(): ?string
    {
        return $this->waitSetId;
    }

    /**
     * Set waitSetId
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new QueryWaitSetEnvelope(new QueryWaitSetBody($this));
    }
}
