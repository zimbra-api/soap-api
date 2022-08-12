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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Account\Struct\Identity;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetIdentitiesResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetIdentitiesResponse extends SoapResponse
{
    /**
     * Identities
     * 
     * @Accessor(getter="getIdentities", setter="setIdentities")
     * @Type("array<Zimbra\Account\Struct\Identity>")
     * @XmlList(inline=true, entry="identity", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getIdentities', setter: 'setIdentities')]
    #[Type(name: 'array<Zimbra\Account\Struct\Identity>')]
    #[XmlList(inline: true, entry: 'identity', namespace: 'urn:zimbraAccount')]
    private $identities = [];

    /**
     * Constructor
     *
     * @param array $identities
     * @return self
     */
    public function __construct(array $identities = [])
    {
        $this->setIdentities($identities);
    }

    /**
     * Set identities
     *
     * @param  array $identities
     * @return self
     */
    public function setIdentities(array $identities): self
    {
        $this->identities = array_filter($identities, static fn ($identity) => $identity instanceof Identity);
        return $this;
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return $this->identities;
    }
}
