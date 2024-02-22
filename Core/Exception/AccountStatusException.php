<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Core\Exception;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * AccountStatusException is the base class for authentication exceptions
 * caused by the user account status.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Alexander <iam.asm89@gmail.com>
 */
abstract class AccountStatusException extends AuthenticationException
{
    private $user;

    /**
     * Get the user.
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the user.
     *
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
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
            $this->user,
            parent::serialize(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($str)
    {
        $this->__unserialize(unserialize($str));
    }

    public function __unserialize($data)
    {
        list($this->user, $parentData) = $data;

        parent::unserialize($parentData);
    }
}
