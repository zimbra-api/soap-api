<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * ServerInfo struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="server")
 */
class ServerInfo extends AdminObjectInfo
{
    /**
     * Constructor method for AdminObjectInfo
     * 
     * @param  string $name Name
     * @param  string $id ID
     * @param  array  $attrs Attributes
     * @return self
     */
    public function __construct($name = NULL, $id = NULL, array $attrs = [])
    {
        parent::__construct($name, $id, $attrs);
    }
}
