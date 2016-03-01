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
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
        $this->setProperty('id', trim($id));
        if(null !== $ver)
        {
            $this->setProperty('ver', (int) $ver);
        }
        if(null !== $count)
        {
            $this->setProperty('count', (int) $count);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->getProperty('ver');
    }

    /**
     * Sets version
     *
     * @param  int $ver
     * @return self
     */
    public function setVersion($ver)
    {
        return $this->setProperty('ver', (int) $ver);
    }

    /**
     * Gets count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->getProperty('count');
    }

    /**
     * Sets count
     *
     * @param  int $count
     * @return self
     */
    public function setCount($count)
    {
        return $this->setProperty('count', (int) $count);
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
