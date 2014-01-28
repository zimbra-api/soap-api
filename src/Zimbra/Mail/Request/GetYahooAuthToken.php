<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Soap\Request;

/**
 * GetYahooAuthToken request class
 * Get Yahoo Auth Token
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetYahooAuthToken extends Request
{
    /**
     * Constructor method for GetYahooAuthToken
     * @param  string $user
     * @param  string $password
     * @return self
     */
    public function __construct($user, $password)
    {
        parent::__construct();
        $this->property('user', trim($user));
        $this->property('password', trim($password));
    }

    /**
     * Gets or sets user
     *
     * @param  string $user
     * @return string|self
     */
    public function user($user = null)
    {
        if(null === $user)
        {
            return $this->property('user');
        }
        return $this->property('user', trim($user));
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->property('password');
        }
        return $this->property('password', trim($password));
    }
}
