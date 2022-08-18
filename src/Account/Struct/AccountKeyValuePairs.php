<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Struct\{KeyValuePairs, KeyValuePairsTrait};

/**
 * AccountKeyValuePairs struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountKeyValuePairs implements KeyValuePairs
{
    use KeyValuePairsTrait;

    /**
     * Key value pairs
     * 
     * @Accessor(getter="getKeyValuePairs", setter="setKeyValuePairs")
     * @Type("array<Zimbra\Common\Struct\KeyValuePair>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getKeyValuePairs', setter: 'setKeyValuePairs')]
    #[Type('array<Zimbra\Common\Struct\KeyValuePair>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraAccount')]
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
