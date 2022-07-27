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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * CountAccountResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CountAccountResponse implements SoapResponseInterface
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
     * Constructor method for CountAccountResponse
     *
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
     * @param  array $coses
     * @return self
     */
    public function setCos(array $coses): self
    {
        $this->cos = array_filter($coses, static fn ($cos) => $cos instanceof CosCountInfo);
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
