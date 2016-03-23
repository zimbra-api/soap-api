<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use PhpCollection\Sequence;

/**
 * RefreshRegisteredAuthTokens request class
 * Deregister authtokens that have been deregistered on the sending server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RefreshRegisteredAuthTokens extends Base
{
    /**
     * Tokens
     * @var Sequence
     */
    private $_tokens;

    /**
     * Constructor method for RefreshRegisteredAuthTokens
     * @param  string $id Zimbra ID
     * @param  array  $tokens Tokens
     * @return self
     */
    public function __construct(array $tokens)
    {
        parent::__construct();
        $this->setTokens($tokens);

        $this->on('before', function(Base $sender)
        {
            if($sender->getTokens()->count())
            {
                $sender->setChild('token', $sender->getTokens()->all());
            }
        });
    }

    /**
     * Add a auth token
     *
     * @param  string $token
     * @return self
     */
    public function addToken($token)
    {
        $token = trim($token);
        if(!empty($token) && !$this->_tokens->contains($token))
        {
            $this->_tokens->add($token);
        }
        return $this;
    }

    /**
     * Sets token sequence
     *
     * @param  array  $tokens Tokens
     * @return self
     */
    public function setTokens(array $tokens)
    {
        $this->_tokens = new Sequence;
        foreach ($tokens as $token)
        {
            $token = trim($token);
            if(!empty($token) && !$this->_tokens->contains($token))
            {
                $this->_tokens->add($token);
            }
        }
        if(count($this->_tokens) === 0)
        {
            throw new \InvalidArgumentException('RefreshRegisteredAuthTokens must have at least one token');
        }
        return $this;
    }

    /**
     * Gets token sequence
     *
     * @return Sequence
     */
    public function getTokens()
    {
        return $this->_tokens;
    }
}
