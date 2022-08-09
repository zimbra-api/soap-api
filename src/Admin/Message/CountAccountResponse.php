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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CountAccountResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CountAccountResponse extends SoapResponse
{
    /**
     * Account count information by Class Of Service (COS)
     * 
     * @Accessor(getter="getCos", setter="setCos")
     * @Type("array<Zimbra\Admin\Struct\CosCountInfo>")
     * @XmlList(inline=true, entry="cos", namespace="urn:zimbraAdmin")
     */
    private $cos = [];

    /**
     * Constructor
     *
     * @param array $cos
     * @return self
     */
    public function __construct(array $cos = [])
    {
        $this->setCos($cos);
    }

    /**
     * Set cos quotas
     *
     * @param  array $coses
     * @return self
     */
    public function setCos(array $coses): self
    {
        $this->cos = array_filter($coses, static fn ($cos) => $cos instanceof CosCountInfo);
        return $this;
    }

    /**
     * Get cos quotas
     *
     * @return array
     */
    public function getCos(): array
    {
        return $this->cos;
    }
}
