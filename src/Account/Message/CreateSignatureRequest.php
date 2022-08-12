<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Account\Struct\Signature;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateSignatureRequest class
 * Create a signature.
 * If an id is provided it will be honored as the id for the signature. 
 * CreateSignature will set account default signature to the signature being created if there is currently no default signature for the account.
 * There can be at most one text/plain signatue and one text/html signature. 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateSignatureRequest extends SoapRequest
{
    /**
     * Details of the signature to be created
     * 
     * @Accessor(getter="getSignature", setter="setSignature")
     * @SerializedName("signature")
     * @Type("Zimbra\Account\Struct\Signature")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var Signature
     */
    #[Accessor(getter: 'getSignature', setter: 'setSignature')]
    #[SerializedName(name: 'signature')]
    #[Type(name: Signature::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $signature;

    /**
     * Constructor
     * 
     * @param Signature $signature
     * @return self
     */
    public function __construct(Signature $signature)
    {
        $this->setSignature($signature);
    }

    /**
     * Get the signature.
     *
     * @return Signature
     */
    public function getSignature(): Signature
    {
        return $this->signature;
    }

    /**
     * Set the signature.
     *
     * @param  Signature $signature
     * @return self
     */
    public function setSignature(Signature $signature): self
    {
        $this->signature = $signature;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateSignatureEnvelope(
            new CreateSignatureBody($this)
        );
    }
}
