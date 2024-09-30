<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * With request id trait.
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
trait WithRequestIdTrait
{
    /**
     * Request id. Used with BatchRequestInterface & BatchResponseInterface
     *
     * @Accessor(getter="getRequestId", setter="setRequestId")
     * @SerializedName("requestId")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getRequestId", setter: "setRequestId")]
    #[SerializedName("requestId")]
    #[Type("string")]
    #[XmlAttribute]
    private $requestId;

    /**
     * Get the request id
     *
     * @return string
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * Set the request id
     *
     * @param  string $requestId
     * @return self
     */
    public function setRequestId(string $requestId): self
    {
        $this->requestId = $requestId;
        return $this;
    }
}
