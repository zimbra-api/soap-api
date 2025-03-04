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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlList
};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SaveIMAPSubscriptionsRequest class
 * Save a list of folder names subscribed to via IMAP
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SaveIMAPSubscriptionsRequest extends SoapRequest
{
    /**
     * list of folder paths subscribed via IMAP
     *
     * @var array
     */
    #[Accessor(getter: "getSubscriptions", setter: "setSubscriptions")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "sub", namespace: "urn:zimbraMail")]
    private array $subscriptions = [];

    /**
     * Constructor
     *
     * @param  array $subscriptions
     * @return self
     */
    public function __construct(array $subscriptions = [])
    {
        $this->setSubscriptions($subscriptions);
    }

    /**
     * Add a subscription
     *
     * @param  string $subscription
     * @return self
     */
    public function addSubscription($subscription): self
    {
        $subscription = trim($subscription);
        if (
            !empty($subscription) &&
            !in_array($subscription, $this->subscriptions)
        ) {
            $this->subscriptions[] = $subscription;
        }
        return $this;
    }

    /**
     * Set subscriptions
     *
     * @param  array $subscriptions
     * @return self
     */
    public function setSubscriptions(array $subscriptions): self
    {
        $this->subscriptions = array_unique($subscriptions);
        return $this;
    }

    /**
     * Get subscriptions
     *
     * @return array
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SaveIMAPSubscriptionsEnvelope(
            new SaveIMAPSubscriptionsBody($this)
        );
    }
}
