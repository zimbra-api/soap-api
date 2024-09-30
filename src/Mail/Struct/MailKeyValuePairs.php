<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Struct\{KeyValuePairs, KeyValuePairsTrait};

/**
 * MailKeyValuePairs class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailKeyValuePairs implements KeyValuePairs
{
    use KeyValuePairsTrait;

    /**
     * Key value pairs
     *
     * @Accessor(getter="getKeyValuePairs", setter="setKeyValuePairs")
     * @Type("array<Zimbra\Common\Struct\KeyValuePair>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getKeyValuePairs", setter: "setKeyValuePairs")]
    #[Type("array<Zimbra\Common\Struct\KeyValuePair>")]
    #[XmlList(inline: true, entry: "a", namespace: "urn:zimbraMail")]
    protected $keyValuePairs = [];

    /**
     * Constructor
     *
     * @param array $keyValuePairs
     */
    public function __construct(array $keyValuePairs = [])
    {
        $this->setKeyValuePairs($keyValuePairs);
    }
}
