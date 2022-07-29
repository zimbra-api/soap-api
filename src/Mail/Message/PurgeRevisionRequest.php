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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\PurgeRevisionSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * PurgeRevisionRequest class
 * Purge revision
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class PurgeRevisionRequest extends SoapRequest
{
    /**
     * Specification or revision to purge
     * 
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("revision")
     * @Type("Zimbra\Mail\Struct\PurgeRevisionSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private PurgeRevisionSpec $revision;

    /**
     * Constructor method for PurgeRevisionRequest
     *
     * @param  PurgeRevisionSpec $revision
     * @return self
     */
    public function __construct(PurgeRevisionSpec $revision)
    {
        $this->setRevision($revision);
    }

    /**
     * Get revision
     *
     * @return PurgeRevisionSpec
     */
    public function getRevision(): PurgeRevisionSpec
    {
        return $this->revision;
    }

    /**
     * Set revision
     *
     * @param  PurgeRevisionSpec $revision
     * @return self
     */
    public function setRevision(PurgeRevisionSpec $revision): self
    {
        $this->revision = $revision;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new PurgeRevisionEnvelope(
            new PurgeRevisionBody($this)
        );
    }
}
