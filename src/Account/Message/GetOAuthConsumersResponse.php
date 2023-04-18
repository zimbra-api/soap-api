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
use Zimbra\Account\Struct\OAuthConsumer;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetOAuthConsumersResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetOAuthConsumersResponse extends SoapResponse
{
    /**
     * Consumers
     * 
     * @Accessor(getter="getConsumers", setter="setConsumers")
     * @Type("array<Zimbra\Account\Struct\OAuthConsumer>")
     * @XmlList(inline=true, entry="OAuthConsumer", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getConsumers', setter: 'setConsumers')]
    #[Type('array<Zimbra\Account\Struct\OAuthConsumer>')]
    #[XmlList(inline: true, entry: 'OAuthConsumer', namespace: 'urn:zimbraAccount')]
    private $consumers = [];

    /**
     * Constructor
     *
     * @param array $consumers
     * @return self
     */
    public function __construct(array $consumers = [])
    {
        $this->setConsumers($consumers);
    }

    /**
     * Set consumers
     *
     * @param  array $consumers
     * @return self
     */
    public function setConsumers(array $consumers): self
    {
        $this->consumers = array_filter(
            $consumers, static fn ($consumer) => $consumer instanceof OAuthConsumer
        );
        return $this;
    }

    /**
     * Get consumers
     *
     * @return array
     */
    public function getConsumers(): array
    {
        return $this->consumers;
    }
}
