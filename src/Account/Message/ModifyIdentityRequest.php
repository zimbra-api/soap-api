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
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * ModifyIdentityRequest class
 * Modify an Identity
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyIdentityRequest extends Request
{
    /**
     * Specify identity to be modified
     * Must specify either "name" or "id" attribute
     * @Accessor(getter="getIdentity", setter="setIdentity")
     * @SerializedName("identity")
     * @Type("Zimbra\Account\Struct\Identity")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private Identity $identity;

    /**
     * Constructor method for ModifyIdentityRequest
     * 
     * @param Identity $identity
     * @return self
     */
    public function __construct(Identity $identity)
    {
        $this->setIdentity($identity);
    }

    /**
     * Gets the identity.
     *
     * @return Identity
     */
    public function getIdentity(): Identity
    {
        return $this->identity;
    }

    /**
     * Sets the identity.
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new ModifyIdentityEnvelope(
            new ModifyIdentityBody($this)
        );
    }
}
