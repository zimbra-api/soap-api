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
use Zimbra\Common\Struct\ShareInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetShareInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetShareInfoResponse extends SoapResponse
{
    /**
     * Shares
     * 
     * @Accessor(getter="getShares", setter="setShares")
     * @Type("array<Zimbra\Common\Struct\ShareInfo>")
     * @XmlList(inline=true, entry="share", namespace="urn:zimbraAccount")
     */
    private $shares = [];

    /**
     * Constructor
     * 
     * @param  array $shares
     * @return self
     */
    public function __construct(array $shares = [])
    {
        $this->setShares($shares);
    }

    /**
     * Add a share
     *
     * @param  ShareInfo $share
     * @return self
     */
    public function addShare(ShareInfo $share): self
    {
        $this->shares[] = $share;
        return $this;
    }

    /**
     * Set shares
     *
     * @param  array $shares
     * @return self
     */
    public function setShares(array $shares): self
    {
        $this->shares = array_filter($shares, static fn ($share) => $share instanceof ShareInfo);
        return $this;
    }

    /**
     * Get shares
     *
     * @return array
     */
    public function getShares(): array
    {
        return $this->shares;
    }
}
