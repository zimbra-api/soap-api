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
use Zimbra\Common\Struct\SoapResponse;

/**
 * ListIMAPSubscriptionsResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ListIMAPSubscriptionsResponse extends SoapResponse
{
    /**
     * list of folder paths subscribed via IMAP
     *
     * @Accessor(getter="getSubscriptions", setter="setSubscriptions")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="sub", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getSubscriptions", setter: "setSubscriptions")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "sub", namespace: "urn:zimbraMail")]
    private $subs = [];

    /**
     * Constructor
     *
     * @param  array $subs
     * @return self
     */
    public function __construct(array $subs = [])
    {
        $this->setSubscriptions($subs);
    }

    /**
     * Set subscriptions
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
     * Get subscriptions
     *
     * @return array
     */
    public function getSubscriptions(): array
    {
        return $this->subs;
    }
}
