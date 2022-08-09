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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\GrantInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetGrantsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetGrantsResponse extends SoapResponse
{
    /**
     * Information about grants
     * 
     * @Accessor(getter="getGrants", setter="setGrants")
     * @Type("array<Zimbra\Admin\Struct\GrantInfo>")
     * @XmlList(inline=true, entry="grant", namespace="urn:zimbraAdmin")
     */
    private $grants = [];

    /**
     * Constructor
     *
     * @param  array $grants
     * @return self
     */
    public function __construct(array $grants = [])
    {
        $this->setGrants($grants);
    }

    /**
     * Set grants
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
     * Get grants
     *
     * @return array
     */
    public function getGrants(): array
    {
        return $this->grants;
    }
}
