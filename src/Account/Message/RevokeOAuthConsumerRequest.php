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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * RevokeOAuthConsumerRequest class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RevokeOAuthConsumerRequest extends Request
{
    /**
     * @Accessor(getter="getAccessToken", setter="setAccessToken")
     * @SerializedName("accessToken")
     * @Type("string")
     * @XmlAttribute
     */
    private $accessToken;

    /**
     * Constructor method for RevokeOAuthConsumerRequest
     * 
     * @param string $accessToken
     * @return self
     */
    public function __construct(string $accessToken = '')
    {
        $this->setAccessToken($accessToken);
    }

    /**
     * Gets the accessToken.
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * Sets the accessToken.
     *
     * @param  string $accessToken
     * @return self
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RevokeOAuthConsumerEnvelope(
            new RevokeOAuthConsumerBody($this)
        );
    }
}
