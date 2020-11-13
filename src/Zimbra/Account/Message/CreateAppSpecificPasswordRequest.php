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
 * CreateAppSpecificPasswordRequest class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateAppSpecificPasswordRequest", namespace="urn:zimbraAccount")
 */
class CreateAppSpecificPasswordRequest extends Request
{
    /**
     * @Accessor(getter="getAppName", setter="setAppName")
     * @SerializedName("appName")
     * @Type("string")
     * @XmlAttribute
     */
    private $appName;

    /**
     * Constructor method for CreateAppSpecificPasswordRequest
     * @param  string $appName
     * @return self
     */
    public function __construct($appName = NULL)
    {
        if(NULL !== $appName) {
            $this->setAppName($appName);
        }
    }

    /**
     * Gets want app token
     *
     * @return string
     */
    public function getAppName(): ?string
    {
        return $this->appName;
    }

    /**
     * Sets want app token
     *
     * @param  string $appName
     * @return self
     */
    public function setAppName($appName): self
    {
        $this->appName = (string) $appName;
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new CreateAppSpecificPasswordEnvelope(
            NULL,
            new CreateAppSpecificPasswordBody($this)
        );
    }
}
