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
use Zimbra\Soap\ResponseInterface;

/**
 * ListIMAPSubscriptionsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ListIMAPSubscriptionsResponse implements ResponseInterface
{
    /**
     * list of folder paths subscribed via IMAP
     * 
     * @Accessor(getter="getSubscriptions", setter="setSubscriptions")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="sub", namespace="urn:zimbraMail")
     */
    private $subs = [];

    /**
     * Constructor method for ListIMAPSubscriptionsResponse
     *
     * @param  array $subs
     * @return self
     */
    public function __construct(array $subs = [])
    {
        $this->setSubscriptions($subs);
    }

    /**
     * Add subscription
     *
     * @param  string $sub
     * @return self
     */
    public function addSubscription(string $sub): self
    {
        $sub = trim($sub);
        if (!empty($sub) && !in_array($sub, $this->subs)) {
            $this->subs[] = $sub;
        }
        return $this;
    }

    /**
     * Sets subscriptions
     *
     * @param  array $subs
     * @return self
     */
    public function setSubscriptions(array $subs): self
    {
        $this->subs = array_unique($subs);
        return $this;
    }

    /**
     * Gets subscriptions
     *
     * @return array
     */
    public function getSubscriptions(): array
    {
        return $this->subs;
    }
}
