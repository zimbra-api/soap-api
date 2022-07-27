<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\BrowseData;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * BrowseResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class BrowseResponse implements SoapResponseInterface
{
    /**
     * Browse data
     * 
     * @Accessor(getter="getBrowseDatas", setter="setBrowseDatas")
     * @Type("array<Zimbra\Mail\Struct\BrowseData>")
     * @XmlList(inline=true, entry="bd", namespace="urn:zimbraMail")
     */
    private $browseDatas = [];

    /**
     * Constructor method for BrowseResponse
     *
     * @param  array $browseDatas
     * @return self
     */
    public function __construct(array $browseDatas = [])
    {
        $this->setBrowseDatas($browseDatas);
    }

    /**
     * Add browseData
     *
     * @param  BrowseData $browseData
     * @return self
     */
    public function addBrowseData(BrowseData $browseData): self
    {
        $this->browseDatas[] = $browseData;
        return $this;
    }

    /**
     * Sets browseDatas
     *
     * @param  array $datas
     * @return self
     */
    public function setBrowseDatas(array $datas): self
    {
        $this->browseDatas = array_filter($datas, static fn ($data) => $data instanceof BrowseData);
        return $this;
    }

    /**
     * Gets browseDatas
     *
     * @return array
     */
    public function getBrowseDatas(): array
    {
        return $this->browseDatas;
    }
}
