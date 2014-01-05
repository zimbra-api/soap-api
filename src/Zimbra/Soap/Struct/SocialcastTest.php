<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * SocialcastTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SocialcastTest extends FilterTest
{
    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'socialcastTest')
    {
        $name = !empty($name) ? $name : 'socialcastTest';
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'socialcastTest')
    {
        $name = !empty($name) ? $name : 'socialcastTest';
        return parent::toXml($name);
    }
}
