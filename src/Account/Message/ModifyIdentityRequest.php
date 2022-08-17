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
 * ModifyIdentityRequest class
 * Modify an Identity
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyIdentityRequest extends SoapRequest
{
    /**
     * Specify identity to be modified
     * Must specify either "name" or "id" attribute
     * 
     * @Accessor(getter="getIdentity", setter="setIdentity")
     * @SerializedName("identity")
     * @Type("Zimbra\Account\Struct\Identity")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var Identity
     */
    #[Accessor(getter: 'getIdentity', setter: 'setIdentity')]
    #[SerializedName(name: 'identity')]
    #[Type(name: Identity::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $identity;

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
        return new ModifyIdentityEnvelope(
            new ModifyIdentityBody($this)
        );
    }
}
