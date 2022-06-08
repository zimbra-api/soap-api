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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * RefreshRegisteredAuthTokensRequest request class
 * Deregister authtokens that have been deregistered on the sending server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RefreshRegisteredAuthTokensRequest extends Request
{
    /**
     * Tokens
     * 
     * @Accessor(getter="getTokens", setter="setTokens")
     * @SerializedName("token")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "token")
     */
    private $tokens = [];

    /**
     * Constructor method for RefreshRegisteredAuthTokensRequest
     *
     * @param  array $tokens
     * @return self
     */
    public function __construct(array $tokens = [])
    {
        $this->setTokens($tokens);
    }

    /**
     * Add token
     *
     * @param  string $token
     * @return self
     */
    public function addToken(string $token): self
    {
        $token = trim($token);
        if (!empty($token) && !in_array($token, $this->tokens)) {
            $this->tokens[] = $token;
        }
        return $this;
    }

    /**
     * Sets tokens
     *
     * @param  array $tokens Members
     * @return self
     */
    public function setTokens(array $tokens): self
    {
        $this->tokens = array_unique(array_map(static fn ($token) => trim($token), $tokens));
        return $this;
    }

    /**
     * Gets tokens
     *
     * @return array
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RefreshRegisteredAuthTokensEnvelope(
            new RefreshRegisteredAuthTokensBody($this)
        );
    }
}
