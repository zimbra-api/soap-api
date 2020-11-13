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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Soap\Request;

/**
 * BootstrapMobileGatewayAppRequest class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="BootstrapMobileGatewayAppRequest", namespace="urn:zimbraAccount")
 */
class BootstrapMobileGatewayAppRequest extends Request
{
    /**
     * @Accessor(getter="getWantAppToken", setter="setWantAppToken")
     * @SerializedName("wantAppToken")
     * @Type("bool")
     * @XmlAttribute
     */
    private $wantAppToken;

    /**
     * Constructor method for BootstrapMobileGatewayAppRequest
     * @param  bool $wantAppToken whether an "anticipatory app account" auth token is desired
     * @return self
     */
    public function __construct($wantAppToken = NULL)
    {
        if(NULL !== $wantAppToken) {
            $this->setWantAppToken($wantAppToken);
        }
    }

    /**
     * Gets want app token
     *
     * @return bool
     */
    public function getWantAppToken(): ?bool
    {
        return $this->wantAppToken;
    }

    /**
     * Sets want app token
     *
     * @param  bool $wantAppToken
     * @return self
     */
    public function setWantAppToken($wantAppToken): self
    {
        $this->wantAppToken = (bool) $wantAppToken;
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new BootstrapMobileGatewayAppEnvelope(
            NULL,
            new BootstrapMobileGatewayAppBody($this)
        );
    }
}
