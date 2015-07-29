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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * FolderActionSelectorAcl struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FolderActionSelectorAcl extends Base
{
    /**
     * Access control list
     * @var TypedSequence<ActionGrantSelector>
     */
    private $_grants;

    /**
     * Constructor method for FolderActionSelectorAcl
     * @param array $grants Access control list
     * @return self
     */
    public function __construct(array $grants = [])
    {
        parent::__construct();
        $this->setGrants($grants);
        $this->on('before', function(Base $sender)
        {
            if($sender->getGrants()->count())
            {
                $sender->setChild('grant', $sender->getGrants()->all());
            }
        });
    }

    /**
     * Add grant
     *
     * @param  ActionGrantSelector $grant
     * @return self
     */
    public function addGrant(ActionGrantSelector $grant)
    {
        $this->_grants->add($grant);
        return $this;
    }

    /**
     * Sets grant sequence
     *
     * @param  array $grants
     * @return self
     */
    public function setGrants(array $grants)
    {
        $this->_grants = new TypedSequence('Zimbra\Mail\Struct\ActionGrantSelector', $grants);
        return $this;
    }

    /**
     * Gets grant sequence
     *
     * @return Sequence
     */
    public function getGrants()
    {
        return $this->_grants;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'acl')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'acl')
    {
        return parent::toXml($name);
    }
}
