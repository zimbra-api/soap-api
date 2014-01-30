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
        $this->property('id', trim($id));
        $this->property('ver', (int) $ver);
        if(null !== $includeOlderRevisions)
        {
            $this->property('includeOlderRevisions', (bool) $includeOlderRevisions);
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
     * Gets or sets includeOlderRevisions
     *
     * @param  bool $includeOlderRevisions
     * @return bool|self
     */
    public function includeOlderRevisions($includeOlderRevisions = null)
    {
        if(null === $includeOlderRevisions)
        {
            return $this->property('includeOlderRevisions');
        }
        return $this->property('includeOlderRevisions', (bool) $includeOlderRevisions);
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
