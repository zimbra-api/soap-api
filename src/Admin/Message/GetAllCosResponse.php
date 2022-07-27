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
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetAllCosResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllCosResponse implements SoapResponseInterface
{
    /**
     * Information on Classes of Service (COS)
     * 
     * @Accessor(getter="getCosList", setter="setCosList")
     * @Type("array<Zimbra\Admin\Struct\CosInfo>")
     * @XmlList(inline=true, entry="cos", namespace="urn:zimbraAdmin")
     */
    private $cosList = [];

    /**
     * Constructor method for GetAllCosResponse
     *
     * @param array $cosList
     * @return self
     */
    public function __construct(array $cosList = [])
    {
        $this->setCosList($cosList);
    }

    /**
     * Add cos
     *
     * @param  CosInfo $cos
     * @return self
     */
    public function addCos(CosInfo $cos): self
    {
        $this->cosList[] = $cos;
        return $this;
    }

    /**
     * Sets cosList
     *
     * @param  array $cosList
     * @return self
     */
    public function setCosList(array $cosList): self
    {
        $this->cosList = array_filter($cosList, static fn ($cos) => $cos instanceof CosInfo);
        return $this;
    }

    /**
     * Gets cosList
     *
     * @return array
     */
    public function getCosList(): array
    {
        return $this->cosList;
    }
}
