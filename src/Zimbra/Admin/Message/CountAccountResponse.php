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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CountAccountResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CountAccountResponse")
 */
class CountAccountResponse implements ResponseInterface
{
    /**
     * Account count information by Class Of Service (COS)
     * 
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("array<Zimbra\Admin\Struct\CosCountInfo>")
     * @XmlList(inline = true, entry = "cos")
     */
    private $cos;

    /**
     * Constructor method for CountAccountResponse
     * @param array $cos
     * @return self
     */
    public function __construct(array $cos = [])
    {
        $this->setCos($cos);
    }

    /**
     * Add a cos quota
     *
     * @param  CosCountInfo $cos
     * @return self
     */
    public function addCos(CosCountInfo $cos): self
    {
        $this->cos[] = $cos;
        return $this;
    }

    /**
     * Sets cos quotas
     *
     * @param  array $cos
     * @return self
     */
    public function setCos(array $cos): self
    {
        $this->cos = [];
        foreach ($cos as $cos) {
            if ($cos instanceof CosCountInfo) {
                $this->cos[] = $cos;
            }
        }
        return $this;
    }

    /**
     * Gets cos quotas
     *
     * @return array
     */
    public function getCos(): array
    {
        return $this->cos;
    }
}
