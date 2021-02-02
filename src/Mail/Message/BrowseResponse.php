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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Mail\Struct\BrowseData;
use Zimbra\Soap\ResponseInterface;

/**
 * BrowseResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="BrowseResponse")
 */
class BrowseResponse implements ResponseInterface
{
    /**
     * Browse data
     * 
     * @Accessor(getter="getBrowseDatas", setter="setBrowseDatas")
     * @SerializedName("bd")
     * @Type("array<Zimbra\Mail\Struct\BrowseData>")
     * @XmlList(inline = true, entry = "bd")
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
     * @param  array $browseDatas
     * @return self
     */
    public function setBrowseDatas(array $browseDatas): self
    {
        $this->browseDatas = [];
        foreach ($browseDatas as $browseData) {
            if ($browseData instanceof BrowseData) {
                $this->browseDatas[] = $browseData;
            }
        }
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
