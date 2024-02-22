<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Acl\Domain;

use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Security\Acl\Model\FieldEntryInterface;
use Symfony\Component\Security\Acl\Model\SecurityIdentityInterface;

/**
 * Field-aware ACE implementation which is auditable.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class FieldEntry extends Entry implements FieldEntryInterface
{
    private $field;

    /**
     * Constructor.
     *
     * @param int                       $id
     * @param AclInterface              $acl
     * @param string                    $field
     * @param SecurityIdentityInterface $sid
     * @param string                    $strategy
     * @param int                       $mask
     * @param bool                      $granting
     * @param bool                      $auditFailure
     * @param bool                      $auditSuccess
     */
    public function __construct($id, AclInterface $acl, $field, SecurityIdentityInterface $sid, $strategy, $mask, $granting, $auditFailure, $auditSuccess)
    {
        parent::__construct($id, $acl, $sid, $strategy, $mask, $granting, $auditFailure, $auditSuccess);

        $this->field = $field;
    }

    /**
     * {@inheritdoc}
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize($this->__serialize());
    }

    public function __serialize()
    {
        return array(
            $this->field,
            parent::serialize(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $this->__unserialize(unserialize($serialized));
    }

    public function __unserialize($data)
    {
        list($this->field, $parentStr) = $data;
        parent::unserialize($parentStr);
    }
}
