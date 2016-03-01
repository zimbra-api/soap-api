<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\DistributionListSelector as DistList;
use Zimbra\Common\TypedSequence;

/**
 * GetDistributionList request class
 * Get a distribution list, optionally with ownership information an granted rights. 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDistributionList extends Base
{
    /**
     * The attribute
     * @var TypedSequence<Attr>
     */
    private $_attrs;

    /**
     * Constructor method for getDistributionList
     * @param  DistList $dl Specify the distribution list
     * @param  bool     $needOwners Whether to return owners, default is 0 (i.e. Don't return owners)
     * @param  string   $needRights return grants for the specified (comma-seperated) rights. e.g. needRights="sendToDistList,viewDistList"
     * @param  array    $attrs Attributes
     * @return self
     */
    public function __construct(
        DistList $dl,
        $needOwners = null,
        $needRights = null,
        array $attrs = [])
    {
        parent::__construct();
        $this->setChild('dl', $dl);
        if(null !== $needOwners)
        {
            $this->setProperty('needOwners', (bool) $needOwners);
        }
        if(null !== $needRights)
        {
            $this->setProperty('needRights', trim($needRights));
        }
        $this->setAttrs($attrs);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAttrs()->count())
            {
                $sender->setChild('a', $sender->getAttrs()->all());
            }
        });
    }

    /**
     * Gets the dl
     *
     * @return Zimbra\Action\Struct\DistributionListSelector
     */
    public function getDl()
    {
        return $this->getChild('dl');
    }

    /**
     * Sets the dl
     *
     * @param  Zimbra\Action\Struct\DistributionListSelector $dl
     * @return self
     */
    public function setDl(DistList $dl)
    {
        return $this->setChild('dl', $dl);
    }

    /**
     * Gets controls whether the auth token cookie
     *
     * @return bool
     */
    public function getNeedOwners()
    {
        return $this->getProperty('needOwners');
    }

    /**
     * Sets controls whether the auth token cookie
     *
     * @param  bool $needOwners
     * @return self
     */
    public function setNeedOwners($needOwners)
    {
        return $this->setProperty('needOwners', (bool) $needOwners);
    }

    /**
     * Gets need rights
     *
     * @return string
     */
    public function getNeedRights()
    {
        return $this->getProperty('needRights');
    }

    /**
     * Sets need rights
     *
     * @param  string $needRights
     * @return self
     */
    public function setNeedRights($needRights)
    {
        return $this->setProperty('needRights', trim($needRights));
    }

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attrs->add($attr);
        return $this;
    }

    /**
     * Sets attr sequence
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->_attrs = new TypedSequence('Zimbra\Account\Struct\Attr', $attrs);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }
}
