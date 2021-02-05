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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Account\Struct\NameId;
use Zimbra\Soap\Request;

/**
 * DeleteSignatureRequest class
 * Delete a signature
 * must specify either {name} or {id} attribute to <signature>
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DeleteSignatureRequest")
 */
class DeleteSignatureRequest extends Request
{
    /**
     * The signature to delete
     * @Accessor(getter="getSignature", setter="setSignature")
     * @SerializedName("signature")
     * @Type("Zimbra\Account\Struct\NameId")
     * @XmlElement
     */
    private $signature;

    /**
     * Constructor method for DeleteSignatureRequest
     * 
     * @param NameId $signature
     * @return self
     */
    public function __construct(NameId $signature)
    {
        $this->setSignature($signature);
    }

    /**
     * Gets the signature.
     *
     * @return NameId
     */
    public function getSignature(): NameId
    {
        return $this->signature;
    }

    /**
     * Sets the signature.
     *
     * @param  NameId $signature
     * @return self
     */
    public function setSignature(NameId $signature): self
    {
        $this->signature = $signature;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof DeleteSignatureEnvelope)) {
            $this->envelope = new DeleteSignatureEnvelope(
                new DeleteSignatureBody($this)
            );
        }
    }
}