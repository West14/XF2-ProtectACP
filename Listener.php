<?php
/**
 * Created by PhpStorm.
 * User: Andriy
 * Date: 12.06.2019
 * Time: 22:37
 * Made with <3 by West from TechGate Studio
 */

namespace West\ProtectACP;


class Listener
{
    /**
     * @param \XF\Mvc\Controller $controller
     * @param $action
     * @param \XF\Mvc\ParameterBag $params
     * @throws \XF\Mvc\Reply\Exception
     */
    public static function preDispatchAdminLogin(\XF\Mvc\Controller $controller, $action, \XF\Mvc\ParameterBag $params)
    {
        /** @var \XF\Entity\User|null $user */
        $user = \XF::em()->find(
            'XF:User',
            \XF::app()->container('session.public')['userId']
        );

        if (!$user || !$user->is_admin)
        {
            throw $controller->exception($controller->redirect(\XF::app()->router('public')->buildLink('index')));
        }
    }
}