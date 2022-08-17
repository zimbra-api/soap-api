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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SetServerOfflineRequest class
 * Set server offline
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SetServerOfflineRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Server
     * 
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var ServerSelector
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName(name: 'server')]
    #[Type(name: ServerSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $server;

    /**
     * Constructor
     * 
     * @param  ServerSelector $server
     * @param  string $attrs
     * @return self
     */
    public function __construct(?ServerSelector $server = NULL, ?string $attrs = NULL)
    {
        if ($server instanceof ServerSelector) {
            $this->setServer($server);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Get the server.
     *
     * @return ServerSelector
     */
    public function getServer(): ?ServerSelector
    {
        return $this->server;
    }

    /**
     * Set the server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function setServer(ServerSelector $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SetServerOfflineEnvelope(
            new SetServerOfflineBody($this)
        );
    }
}
