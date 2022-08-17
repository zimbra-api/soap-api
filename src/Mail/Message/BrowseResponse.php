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
use Zimbra\Common\Struct\SoapResponse;

/**
 * BrowseResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BrowseResponse extends SoapResponse
{
    /**
     * Browse data
     * 
     * @var array
     */
    #[Accessor(getter: 'getBrowseDatas', setter: 'setBrowseDatas')]
    #[Type(name: 'array<Zimbra\Mail\Struct\BrowseData>')]
    #[XmlList(inline: true, entry: 'bd', namespace: 'urn:zimbraMail')]
    private $browseDatas = [];

    /**
     * Constructor
     *
     * @param  array $browseDatas
     * @return self
     */
    public function __construct(array $browseDatas = [])
    {
        $this->setBrowseDatas($browseDatas);
    }

    /**
     * Set browseDatas
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
     * Get browseDatas
     *
     * @return array
     */
    public function getBrowseDatas(): array
    {
        return $this->browseDatas;
    }
}
