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
use Zimbra\Account\Struct\Identity;
use Zimbra\Soap\Request;

/**
 * ModifyIdentityRequest class
 * Modify an Identity
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ModifyIdentityRequest")
 */
class ModifyIdentityRequest extends Request
{
    /**
     * Specify identity to be modified
     * Must specify either "name" or "id" attribute
     * @Accessor(getter="getIdentity", setter="setIdentity")
     * @SerializedName("identity")
     * @Type("Zimbra\Account\Struct\Identity")
     * @XmlElement
     */
    private $identity;

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
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyIdentityEnvelope)) {
            $this->envelope = new ModifyIdentityEnvelope(
                new ModifyIdentityBody($this)
            );
        }
    }
}