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
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CopyCosResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CopyCosResponse extends SoapResponse
{
    /**
     * Information about copied Class Of Service (COS)
     * 
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var CosInfo
     */
    #[Accessor(getter: 'getCos', setter: 'setCos')]
    #[SerializedName('cos')]
    #[Type(CosInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?CosInfo $cos;

    /**
     * Constructor
     *
     * @param CosInfo $cos
     * @return self
     */
    public function __construct(?CosInfo $cos = NULL)
    {
        $this->cos = $cos;
    }

    /**
     * Get the cos.
     *
     * @return CosInfo
     */
    public function getCos(): ?CosInfo
    {
        return $this->cos;
    }

    /**
     * Set the cos.
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
