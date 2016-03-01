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
 * PurgeRevisionSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PurgeRevisionSpec extends Base
{
    /**
     * Constructor method for PurgeRevisionSpec
     * @param string $id Item ID
     * @param int    $ver Revision
     * @param bool   $includeOlderRevisions When set, the server will purge all the old revisions inclusive of the revision specified in the request.
     * @return self
     */
    public function __construct(
        $id,
        $ver,
        $includeOlderRevisions = null
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('ver', (int) $ver);
        if(null !== $includeOlderRevisions)
        {
            $this->setProperty('includeOlderRevisions', (bool) $includeOlderRevisions);
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
     * Gets include older revs
     *
     * @return bool
     */
    public function getIncludeOlderRevisions()
    {
        return $this->getProperty('includeOlderRevisions');
    }

    /**
     * Sets include older revs
     *
     * @param  bool $includeOlderRevisions
     * @return self
     */
    public function setIncludeOlderRevisions($includeOlderRevisions)
    {
        return $this->setProperty('includeOlderRevisions', (bool) $includeOlderRevisions);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'revision')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'revision')
    {
        return parent::toXml($name);
    }
}
