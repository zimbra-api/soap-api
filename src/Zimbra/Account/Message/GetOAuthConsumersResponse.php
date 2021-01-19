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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Account\Struct\OAuthConsumer;
use Zimbra\Soap\ResponseInterface;

/**
 * GetOAuthConsumersResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetOAuthConsumersResponse")
 */
class GetOAuthConsumersResponse implements ResponseInterface
{
    /**
     * Identities
     * 
     * @Accessor(getter="getConsumers", setter="setConsumers")
     * @SerializedName("OAuthConsumer")
     * @Type("array<Zimbra\Account\Struct\OAuthConsumer>")
     * @XmlList(inline = true, entry = "OAuthConsumer")
     */
    private $consumers;

    /**
     * Constructor method for GetOAuthConsumersResponse
     *
     * @param array $consumers
     * @return self
     */
    public function __construct(array $consumers = [])
    {
        $this->setConsumers($consumers);
    }

    /**
     * Add consumer
     *
     * @param  OAuthConsumer $consumer
     * @return self
     */
    public function addConsumer(OAuthConsumer $consumer): self
    {
        $this->consumers[] = $consumer;
        return $this;
    }

    /**
     * Sets consumers
     *
     * @param  array $consumers
     * @return self
     */
    public function setConsumers(array $consumers): self
    {
        $this->consumers = [];
        foreach ($consumers as $consumer) {
            if ($consumer instanceof OAuthConsumer) {
                $this->consumers[] = $consumer;
            }
        }
        return $this;
    }

    /**
     * Gets consumers
     *
     * @return array
     */
    public function getConsumers(): array
    {
        return $this->consumers;
    }
}
