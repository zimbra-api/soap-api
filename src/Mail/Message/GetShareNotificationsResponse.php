<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\ShareNotificationInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetShareNotificationsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetShareNotificationsResponse implements SoapResponseInterface
{
    /**
     * Share notification information
     * 
     * @Accessor(getter="getShares", setter="setShares")
     * @Type("array<Zimbra\Mail\Struct\ShareNotificationInfo>")
     * @XmlList(inline=true, entry="share", namespace="urn:zimbraMail")
     */
    private $shares = [];

    /**
     * Constructor method for GetShareNotificationsResponse
     *
     * @param  array $shares
     * @return self
     */
    public function __construct(array $shares = [])
    {
        $this->setShares($shares);
    }

    /**
     * Add share notification
     *
     * @param  ShareNotificationInfo $share
     * @return self
     */
    public function addShare(ShareNotificationInfo $share): self
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
        $this->shares = array_filter($shares, static fn ($share) => $share instanceof ShareNotificationInfo);
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
