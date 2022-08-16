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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\SoapResponse;

/**
 * DelegateAuthResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DelegateAuthResponse extends SoapResponse
{
    /**
     * Auth token
     * 
     * @var string
     */
    #[Accessor(getter: 'getAuthToken', setter: 'setAuthToken')]
    #[SerializedName(name: 'authToken')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false,namespace: 'urn:zimbraAdmin')]
    private $authToken;

    /**
     * Life time for the authorization
     * 
     * @var int
     */
    #[Accessor(getter: 'getLifetime', setter: 'setLifetime')]
    #[SerializedName(name: 'lifetime')]
    #[Type(name: 'int')]
    #[XmlElement(cdata: false,namespace: 'urn:zimbraAdmin')]
    private $lifetime;

    /**
     * Constructor
     *
     * @param string $authToken
     * @param int    $lifetime
     * @return self
     */
    public function __construct(string $authToken = '', int $lifetime = 0)
    {
        $this->setAuthToken($authToken)
             ->setLifetime($lifetime);
    }

    /**
     * Get auth token
     *
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * Set auth token
     *
     * @param  string $authToken
     * @return self
     */
    public function setAuthToken(string $authToken): self
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * Get lifetime
     *
     * @return int
     */
    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    /**
     * Set lifetime
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;
        return $this;
    }
}
