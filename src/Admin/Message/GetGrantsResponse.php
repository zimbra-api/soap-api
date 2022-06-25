<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\GrantInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetGrantsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetGrantsResponse implements ResponseInterface
{
    /**
     * Information about grants
     * 
     * @Accessor(getter="getGrants", setter="setGrants")
     * @SerializedName("grant")
     * @Type("array<Zimbra\Admin\Struct\GrantInfo>")
     * @XmlList(inline = true, entry = "grant")
     */
    private $grants = [];

    /**
     * Constructor method for GetGrantsResponse
     *
     * @param  array $grants
     * @return self
     */
    public function __construct(array $grants = [])
    {
        $this->setGrants($grants);
    }

    /**
     * Add a grant
     *
     * @param  GrantInfo $grant
     * @return self
     */
    public function addGrant(GrantInfo $grant): self
    {
        $this->grants[] = $grant;
        return $this;
    }

    /**
     * Sets grants
     *
     * @param  array $grants
     * @return self
     */
    public function setGrants(array $grants): self
    {
        $this->grants = array_filter($grants, static fn ($grant) => $grant instanceof GrantInfo);
        return $this;
    }

    /**
     * Gets grants
     *
     * @return array
     */
    public function getGrants(): array
    {
        return $this->grants;
    }
}
