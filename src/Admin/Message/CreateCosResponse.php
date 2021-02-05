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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateCosResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateCosResponse")
 */
class CreateCosResponse implements ResponseInterface
{
    /**
     * Details of created Class Of Service (COS)
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosInfo")
     * @XmlElement
     */
    private $cos;

    /**
     * Constructor method for CreateCosResponse
     *
     * @param CosInfo $cos
     * @return self
     */
    public function __construct(?CosInfo $cos = NULL)
    {
        if ($cos instanceof CosInfo) {
            $this->setCos($cos);
        }
    }

    /**
     * Gets the COS.
     *
     * @return CosInfo
     */
    public function getCos(): ?CosInfo
    {
        return $this->cos;
    }

    /**
     * Sets the COS
     *
     * @param  CosInfo $cos
     * @return self
     */
    public function setCos(CosInfo $cos): self
    {
        $this->cos = $cos;
        return $this;
    }
}