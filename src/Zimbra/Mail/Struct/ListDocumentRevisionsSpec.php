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
 * ListDocumentRevisionsSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class ListDocumentRevisionsSpec extends Base
{
    /**
     * Constructor method for ListDocumentRevisionsSpec
     * @param string $id Item ID
     * @param int $ver Version
     * @param int $count Maximum number of revisions to return starting from {version}
     * @return self
     */
    public function __construct(
        $id,
        $ver = null,
        $count = null
    )
    {
        parent::__construct();
        $this->property('id', trim($id));
        if(null !== $ver)
        {
            $this->property('ver', (int) $ver);
        }
        if(null !== $count)
        {
            $this->property('count', (int) $count);
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
     * Gets or sets ver
     *
     * @param  int $ver
     * @return int|self
     */
    public function ver($ver = null)
    {
        if(null === $ver)
        {
            return $this->property('ver');
        }
        return $this->property('ver', (int) $ver);
    }

    /**
     * Gets or sets count
     *
     * @param  int $count
     * @return int|self
     */
    public function count($count = null)
    {
        if(null === $count)
        {
            return $this->property('count');
        }
        return $this->property('count', (int) $count);
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
