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

use Zimbra\Enum\DocumentGrantType;
use Zimbra\Enum\DocumentPermission;
use Zimbra\Struct\Base;

/**
 * DocumentActionGrant struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocumentActionGrant extends Base
{
    /**
     * Constructor method for DocumentActionGrant
     * @param DocumentPermission $perm Permissions - (r)ead, (w)rite, (d)elete
     * @param DocumentGrantType $gt Grant type - all|pub
     * @param int $expiry Time when this grant expires in milliseconds since the Epoch
     * @return self
     */
    public function __construct(
        DocumentPermission $perm,
        DocumentGrantType $gt,
        $expiry = null
    )
    {
        parent::__construct();
        $this->setProperty('perm', $perm);
        $this->setProperty('gt', $gt);
        if(null !== $expiry)
        {
            $this->setProperty('expiry', (int) $expiry);
        }
    }

    /**
     * Gets permissions
     *
     * @return DocumentPermission
     */
    public function getRights()
    {
        return $this->getProperty('perm');
    }

    /**
     * Sets permissions
     *
     * @param  DocumentPermission $perm
     * @return self
     */
    public function setRights(DocumentPermission $perm)
    {
        return $this->setProperty('perm', $perm);
    }

    /**
     * Gets grant type
     *
     * @return DocumentGrantType
     */
    public function getGrantType()
    {
        return $this->getProperty('gt');
    }

    /**
     * Sets grant type
     *
     * @param  DocumentGrantType $gt
     * @return self
     */
    public function setGrantType(DocumentGrantType $gt)
    {
        return $this->setProperty('gt', $gt);
    }

    /**
     * Gets expiry
     *
     * @return int
     */
    public function getExpiry()
    {
        return $this->getProperty('expiry');
    }

    /**
     * Sets expiry
     *
     * @param  int $expiry
     * @return self
     */
    public function setExpiry($expiry)
    {
        return $this->setProperty('expiry', (int) $expiry);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'grant')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'grant')
    {
        return parent::toXml($name);
    }
}
