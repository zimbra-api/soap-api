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
use Zimbra\Account\Struct\NameId;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DeleteIdentityRequest class
 * Delete an Identity
 * must specify either {name} or {id} attribute to <identity>
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteIdentityRequest extends SoapRequest
{
    /**
     * Details of the identity to delete.
     * @Accessor(getter="getIdentity", setter="setIdentity")
     * @SerializedName("identity")
     * @Type("Zimbra\Account\Struct\NameId")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private NameId $identity;

    /**
     * Constructor method for DeleteIdentityRequest
     * 
     * @param NameId $identity
     * @return self
     */
    public function __construct(NameId $identity)
    {
        $this->setIdentity($identity);
    }

    /**
     * Gets the identity.
     *
     * @return NameId
     */
    public function getIdentity(): NameId
    {
        return $this->identity;
    }

    /**
     * Sets the identity.
     *
     * @param  NameId $identity
     * @return self
     */
    public function setIdentity(NameId $identity): self
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DeleteIdentityEnvelope(
            new DeleteIdentityBody($this)
        );
    }
}
