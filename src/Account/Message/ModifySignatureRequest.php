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
 * ModifySignatureRequest class
 * Change attributes of the given signature.
 * Only the attributes specified in the request are modified.
 * Note:
 * The Server identifies the signature by id, if the name attribute is present and is different from the current name of the signature, the signature will be renamed. 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifySignatureRequest extends SoapRequest
{
    /**
     * Specifies the changes to the signature
     * 
     * @Accessor(getter="getSignature", setter="setSignature")
     * @SerializedName("signature")
     * @Type("Zimbra\Account\Struct\Signature")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @var Signature
     */
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
        return new ModifySignatureEnvelope(
            new ModifySignatureBody($this)
        );
    }
}
