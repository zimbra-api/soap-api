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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Account\Struct\Identity;
use Zimbra\Soap\ResponseInterface;

/**
 * GetIdentitiesResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetIdentitiesResponse implements ResponseInterface
{
    /**
     * Identities
     * 
     * @Accessor(getter="getIdentities", setter="setIdentities")
     * @SerializedName("identity")
     * @Type("array<Zimbra\Account\Struct\Identity>")
     * @XmlList(inline = true, entry = "identity")
     */
    private $identities = [];

    /**
     * Constructor method for GetIdentitiesResponse
     *
     * @param array $identities
     * @return self
     */
    public function __construct(array $identities = [])
    {
        $this->setIdentities($identities);
    }

    /**
     * Add identity
     *
     * @param  Identity $identity
     * @return self
     */
    public function addIdentity(Identity $identity): self
    {
        $this->identities[] = $identity;
        return $this;
    }

    /**
     * Sets identities
     *
     * @param  array $identities
     * @return self
     */
    public function setIdentities(array $identities): self
    {
        $this->identities = array_filter($identities, static fn($identity) => $identity instanceof Identity);
        return $this;
    }

    /**
     * Gets identities
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return $this->identities;
    }
}
