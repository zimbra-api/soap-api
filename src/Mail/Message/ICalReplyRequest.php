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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ICalReplyRequest class
 * Do an iCalendar Reply
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ICalReplyRequest extends SoapRequest
{
    /**
     * iCalendar text containing components with method REPLY
     * 
     * @Accessor(getter="getIcal", setter="setIcal")
     * @SerializedName("ical")
     * @Type("string")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private $ical;

    /**
     * Constructor method for ICalReplyRequest
     *
     * @param  string $ical
     * @return self
     */
    public function __construct(string $ical = '')
    {
        $this->setIcal($ical);
    }

    /**
     * Get ical
     *
     * @return string
     */
    public function getIcal(): string
    {
        return $this->ical;
    }

    /**
     * Set ical
     *
     * @param  string $ical
     * @return self
     */
    public function setIcal(string $ical): self
    {
        $this->ical = $ical;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ICalReplyEnvelope(
            new ICalReplyBody($this)
        );
    }
}
