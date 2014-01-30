<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * DiffDocumentVersionSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DiffDocumentVersionSpec extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param string $id ID.
     * @param int $v1 Revision 1.
     * @param int $v2 Revision 2.
     * @return self
     */
    public function __construct(
        $id = null,
        $v1 = null,
        $v2 = null
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $v1)
        {
            $this->property('v1', (int) $v1);
        }
        if(null !== $v2)
        {
            $this->property('v2', (int) $v2);
        }
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets v1
     *
     * @param  int $v1
     * @return int|self
     */
    public function v1($v1 = null)
    {
        if(null === $v1)
        {
            return $this->property('v1');
        }
        return $this->property('v1', (int) $v1);
    }

    /**
     * Gets or sets v2
     *
     * @param  int $v2
     * @return int|self
     */
    public function v2($v2 = null)
    {
        if(null === $v2)
        {
            return $this->property('v2');
        }
        return $this->property('v2', (int) $v2);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'doc')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'doc')
    {
        return parent::toXml($name);
    }
}
