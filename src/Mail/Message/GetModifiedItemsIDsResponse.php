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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetModifiedItemsIDsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyinstance © 2020-present by Nguyen Van Nguyen.
 */
class GetModifiedItemsIDsResponse extends SoapResponse
{
    /**
     * IDs of modified items
     * 
     * @var array
     */
    #[Accessor(getter: 'getMids', setter: 'setMids')]
    #[Type('array<int>')]
    #[XmlList(inline: true, entry: 'mids', namespace: 'urn:zimbraMail')]
    private $mids = [];

    /**
     * IDs of deleted items
     * 
     * @var array
     */
    #[Accessor(getter: 'getDids', setter: 'setDids')]
    #[Type('array<int>')]
    #[XmlList(inline: true, entry: 'dids', namespace: 'urn:zimbraMail')]
    private $dids = [];

    /**
     * IDs of modified items
     * 
     * @var array
     */
    #[Accessor(getter: 'getIds', setter: 'setIds')]
    #[Type('array<int>')]
    #[XmlList(inline: true, entry: 'ids', namespace: 'urn:zimbraMail')]
    private $ids = [];

    /**
     * Constructor
     *
     * @param  array $mids
     * @param  array $dids
     * @param  array $ids
     * @return self
     */
    public function __construct(array $mids = [], array $dids = [], array $ids = [])
    {
        $this->setMids($mids)
             ->setDids($dids)
             ->setIds($ids);
    }

    /**
     * Set mids
     *
     * @param  array $mids
     * @return self
     */
    public function setMids(array $mids): self
    {
        $mids = array_map(static fn ($id) => (int) $id, $mids);
        $this->mids = array_unique($mids);
        return $this;
    }

    /**
     * Get mids
     *
     * @return array
     */
    public function getMids(): array
    {
        return $this->mids;
    }

    /**
     * Set dids
     *
     * @param  array $dids
     * @return self
     */
    public function setDids(array $dids): self
    {
        $dids = array_map(static fn ($id) => (int) $id, $dids);
        $this->dids = array_unique($dids);
        return $this;
    }

    /**
     * Get dids
     *
     * @return array
     */
    public function getDids(): array
    {
        return $this->dids;
    }

    /**
     * Set ids
     *
     * @param  array $ids
     * @return self
     */
    public function setIds(array $ids): self
    {
        $ids = array_map(static fn ($id) => (int) $id, $ids);
        $this->ids = array_unique($ids);
        return $this;
    }

    /**
     * Get ids
     *
     * @return array
     */
    public function getIds(): array
    {
        return $this->ids;
    }
}
