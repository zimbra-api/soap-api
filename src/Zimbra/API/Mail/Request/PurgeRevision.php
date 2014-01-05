<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\PurgeRevisionSpec;

/**
 * PurgeRevision request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class PurgeRevision extends Request
{
    /**
     * Specification or revision to purge
     * @var PurgeRevisionSpec
     */
    private $_revision;

    /**
     * Constructor method for PurgeRevision
     * @param  PurgeRevisionSpec $revision
     * @return self
     */
    public function __construct(PurgeRevisionSpec $revision)
    {
        parent::__construct();
        $this->_revision = $revision;
    }

    /**
     * Get or set revision
     *
     * @param  PurgeRevisionSpec $revision
     * @return PurgeRevisionSpec|self
     */
    public function revision(PurgeRevisionSpec $revision = null)
    {
        if(null === $revision)
        {
            return $this->_revision;
        }
        $this->_revision = $revision;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_revision->toArray('revision');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_revision->toXml('revision'));
        return parent::toXml();
    }
}
