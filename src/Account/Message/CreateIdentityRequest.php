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
use Zimbra\Account\Struct\Identity;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateIdentityRequest class
 * Create an Identity
 * Notes:
 * Allowed attributes (see objectclass zimbraIdentity in zimbra.schema)
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateIdentityRequest extends SoapRequest
{
    /**
     * Details of the new identity to create
     *
     * @var Identity
     */
    #[Accessor(getter: "getIdentity", setter: "setIdentity")]
    #[SerializedName("identity")]
    #[Type(Identity::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private Identity $identity;

    /**
     * Constructor
     *
     * @param Identity $identity
     * @return self
     */
    public function __construct(Identity $identity)
    {
        $this->setIdentity($identity);
    }

    /**
     * Get the identity.
     *
     * @return Identity
     */
    public function getIdentity(): Identity
    {
        return $this->identity;
    }

    /**
     * Set the identity.
     *
     * @param  Identity $identity
     * @return self
     */
    public function setIdentity(Identity $identity): self
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateIdentityEnvelope(new CreateIdentityBody($this));
    }
}
