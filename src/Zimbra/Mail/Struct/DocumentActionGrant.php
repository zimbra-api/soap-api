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
        $this->property('perm', $perm);
        $this->property('gt', $gt);
        if(null !== $expiry)
        {
            $this->property('expiry', (int) $expiry);
        }
    }

    /**
     * Gets or sets perm
     *
     * @param  DocumentPermission $perm
     * @return DocumentPermission|self
     */
    public function perm(DocumentPermission $perm = null)
    {
        if(null === $perm)
        {
            return $this->property('perm');
        }
        return $this->property('perm', $perm);
    }

    /**
     * Gets or sets gt
     *
     * @param  DocumentGrantType $gt
     * @return DocumentGrantType|self
     */
    public function gt(DocumentGrantType $gt = null)
    {
        if(null === $gt)
        {
            return $this->property('gt');
        }
        return $this->property('gt', $gt);
    }

    /**
     * Gets or sets expiry
     *
     * @param  int $expiry
     * @return int|self
     */
    public function expiry($expiry = null)
    {
        if(null === $expiry)
        {
            return $this->property('expiry');
        }
        return $this->property('expiry', (int) $expiry);
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
