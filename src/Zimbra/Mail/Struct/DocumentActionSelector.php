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

use Zimbra\Enum\DocumentActionOp;

/**
 * DocumentActionSelector struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocumentActionSelector extends ActionSelector
{
    /**
     * Constructor method for DocumentActionSelector
     * @param DocumentActionOp $op
     * @param DocumentActionGrant $grant Used for "grant" operation
     * @param string $zid Zimbra ID of the grant to revoke (Used for "!grant" operation)
     * @param string $id
     * @param string $tcon
     * @param int    $tag
     * @param string $l
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $f
     * @param string $t
     * @param string $tn
     * @return self
     */
    public function __construct(
        DocumentActionOp $op,
        DocumentActionGrant $grant = null,
        $zid = null,
        $id = null,
        $tcon = null,
        $tag = null,
        $l = null,
        $rgb = null,
        $color = null,
        $name = null,
        $f = null,
        $t = null,
        $tn = null
    )
    {
        parent::__construct(
            $op,
            $id,
            $tcon,
            $tag,
            $l,
            $rgb,
            $color,
            $name,
            $f,
            $t,
            $tn
        );
        if($grant instanceof DocumentActionGrant)
        {
            $this->setChild('grant', $grant);
        }
        if(null !== $zid)
        {
            $this->setProperty('zid', trim($zid));
        }
    }

    /**
     * Gets operation
     *
     * @return DocumentActionOp
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  DocumentActionOp $op
     * @return self
     */
    public function setOperation(DocumentActionOp $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets grant
     *
     * @return DocumentActionGrant
     */
    public function getGrant()
    {
        return $this->getChild('grant');
    }

    /**
     * Sets grant
     *
     * @param  DocumentActionGrant $grant
     * @return self
     */
    public function setGrant(DocumentActionGrant $grant)
    {
        return $this->setChild('grant', $grant);
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getZimbraId()
    {
        return $this->getProperty('zid');
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $zid
     * @return self
     */
    public function setZimbraId($zid)
    {
        return $this->setProperty('zid', trim($zid));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
