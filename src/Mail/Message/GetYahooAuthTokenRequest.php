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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetYahooAuthTokenRequest class
 * Get Yahoo Auth Token
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetYahooAuthTokenRequest extends SoapRequest
{
    /**
     * User
     * 
     * @var string
     */
    #[Accessor(getter: 'getUser', setter: 'setUser')]
    #[SerializedName(name: 'user')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $user;

    /**
     * Password
     * 
     * @var string
     */
    #[Accessor(getter: 'getPassword', setter: 'setPassword')]
    #[SerializedName(name: 'password')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $password;

    /**
     * Constructor
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
     * Get user
     *
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Set user
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
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetYahooAuthTokenEnvelope(
            new GetYahooAuthTokenBody($this)
        );
    }
}
