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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Soap\ResponseInterface;

/**
 * BootstrapMobileGatewayAppResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="BootstrapMobileGatewayAppResponse", namespace="urn:zimbraAccount")
 */
class BootstrapMobileGatewayAppResponse implements ResponseInterface
{
    /**
     * @Accessor(getter="getAppId", setter="setAppId")
     * @SerializedName("appId")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $appId;

    /**
     * @Accessor(getter="getAppKey", setter="setAppKey")
     * @SerializedName("appKey")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $appKey;

    /**
     * @Accessor(getter="getAuthToken", setter="setAuthToken")
     * @SerializedName("authToken")
     * @Type("Zimbra\Account\Struct\AuthToken")
     * @XmlElement
     */
    private $authToken;

    /**
     * Constructor method for BootstrapMobileGatewayAppResponse
     * @param  string $appId Unique app ID for the app
     * @param  string $appKey an app key (or a secret) to enable the app to authenticate itself in the future
     * @param  AuthToken $authToken "Anticipatory" app account auth token
     * @return self
     */
    public function __construct($appId, $appKey, AuthToken $authToken = NULL)
    {
        $this->setAppId($appId)
            ->setAppKey($appKey);
        if($authToken instanceof AuthToken) {
            $this->setAuthToken($authToken);
        }
    }

    /**
     * Gets app ID
     *
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * Sets app ID
     *
     * @param  string $appId
     * @return self
     */
    public function setAppId($appId): self
    {
        $this->appId = (string) $appId;
        return $this;
    }

    /**
     * Gets app key
     *
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * Sets app key
     *
     * @param  string $appKey
     * @return self
     */
    public function setAppKey($appKey): self
    {
        $this->appKey = (string) $appKey;
        return $this;
    }

    /**
     * Gets auth token
     *
     * @return AuthToken
     */
    public function getAuthToken(): ?AuthToken
    {
        return $this->authToken;
    }

    /**
     * Sets auth token
     *
     * @param  AuthToken $authToken
     * @return self
     */
    public function setAuthToken(AuthToken $authToken): self
    {
        $this->authToken = $authToken;
        return $this;
    }
}
