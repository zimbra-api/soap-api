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
use Zimbra\Mail\Struct\MiniCalError;
use Zimbra\Common\Soap\ResponseInterface;

/**
 * GetModifiedItemsIDsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyinstance © 2013-present by Nguyen Van Nguyen.
 */
class GetModifiedItemsIDsResponse implements ResponseInterface
{
    /**
     * IDs of modified items
     * 
     * @Accessor(getter="getIds", setter="setIds")
     * @Type("array<integer>")
     * @XmlList(inline=true, entry="ids", namespace="urn:zimbraMail")
     */
    private $ids = [];

    /**
     * Constructor method for GetModifiedItemsIDsResponse
     *
     * @param  array $ids
     * @return self
     */
    public function __construct(array $ids = [])
    {
        $this->setIds($ids);
    }

    /**
     * Add id
     *
     * @param  int $id
     * @return self
     */
    public function addId(int $id): self
    {
        if (!empty($id) && !in_array($id, $this->ids)) {
            $this->ids[] = $id;
        }
        return $this;
    }

    /**
     * Sets ids
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
     * Gets ids
     *
     * @return array
     */
    public function getIds(): array
    {
        return $this->ids;
    }
}
