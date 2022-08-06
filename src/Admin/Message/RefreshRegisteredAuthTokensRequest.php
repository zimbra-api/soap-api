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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * RefreshRegisteredAuthTokensRequest request class
 * Deregister authtokens that have been deregistered on the sending server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RefreshRegisteredAuthTokensRequest extends SoapRequest
{
    /**
     * Tokens
     * 
     * @Accessor(getter="getTokens", setter="setTokens")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="token", namespace="urn:zimbraAdmin")
     */
    private $tokens = [];

    /**
     * Constructor
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
     * Set tokens
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
     * Get tokens
     *
     * @return array
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RefreshRegisteredAuthTokensEnvelope(
            new RefreshRegisteredAuthTokensBody($this)
        );
    }
}
