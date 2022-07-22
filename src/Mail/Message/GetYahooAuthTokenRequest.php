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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * GetYahooAuthTokenRequest class
 * Get Yahoo Auth Token
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetYahooAuthTokenRequest extends Request
{
    /**
     * User
     * 
     * @Accessor(getter="getUser", setter="setUser")
     * @SerializedName("user")
     * @Type("string")
     * @XmlAttribute
     */
    private $user;

    /**
     * Password
     * 
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlAttribute
     */
    private $password;

    /**
     * Constructor method for GetYahooAuthTokenRequest
     *
     * @param  string $user
     * @param  string $password
     * @return self
     */
    public function __construct(string $user = '', string $password = '')
    {
        $this->setUser($user)
             ->setPassword($password);
    }

    /**
     * Gets user
     *
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Sets user
     *
     * @param  string $user
     * @return self
     */
    public function setUser(string $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetYahooAuthTokenEnvelope(
            new GetYahooAuthTokenBody($this)
        );
    }
}
