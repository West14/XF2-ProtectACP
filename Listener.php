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
    public static function postDispatchAdminLogin(\XF\Mvc\Controller $controller, $action, \XF\Mvc\ParameterBag $params, \XF\Mvc\Reply\AbstractReply &$reply)
    {
        if (strtolower($action) == 'form')
        {
            $cookie = $controller->request()->getCookie('user');
            $redirect = $controller->redirect(\XF::app()->router('public')->buildLink('index'));

            if ($cookie)
            {
                $userId = stristr($cookie, ',', true);
                /** @var \XF\Entity\User $user */
                $user = \XF::em()->find('XF:User', $userId);

                if (!$user || !$user->is_admin) $reply = $redirect;
            }
            else
            {
                $reply = $redirect;
            }
        }
    }
}