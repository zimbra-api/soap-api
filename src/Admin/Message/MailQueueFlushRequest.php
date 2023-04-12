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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{NamedElement, SoapEnvelopeInterface, SoapRequest};

/**
 * MailQueueFlushRequest request class
 * Command to invoke postqueue -f.
 * All queues cached in the server are stale after invoking this because this is a global operation to all the queues in a given server.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailQueueFlushRequest extends SoapRequest
{
    /**
     * Mta server
     * 
     * @var NamedElement
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName('server')]
    #[Type(NamedElement::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private NamedElement $server;

    /**
     * Constructor
     *
     * @param  NamedElement $server
     * @return self
     */
    public function __construct(NamedElement $server)
    {
        $this->setServer($server);
    }

    /**
     * Set the server.
     *
     * @return NamedElement
     */
    public function getServer(): NamedElement
    {
        return $this->server;
    }

    /**
     * Set the server.
     *
     * @param  NamedElement $server
     * @return self
     */
    public function setServer(NamedElement $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new MailQueueFlushEnvelope(
            new MailQueueFlushBody($this)
        );
    }
}
