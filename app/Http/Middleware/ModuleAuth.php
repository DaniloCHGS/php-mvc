<?php

namespace App\Http\Middleware;

use App\Utils\Utils;
use App\Model\Entity\AccessArea as EntityAccessArea;

class ModuleAuth
{
    /**
     * Executa o middleware
     */
    public function handle($request, $next)
    {
        $uri = $this->getUri($request);
        $module = EntityAccessArea::getAccessAreaByURI($uri);

        $userLevel = $_SESSION['admin']['user']['admin'];
        $user_access_area = $_SESSION['admin']['user']['access_area'];

        if ($userLevel == 1 and $module->admin == 1) {

            $modules = explode('-', $user_access_area);

            $hasModule = in_array($module->id, $modules);

            if ($hasModule == 1) {
                return $next($request);
            }
            $request->getRouter()->redirect('/admin?status=denied');
        }

        if ($userLevel >= $module->admin) {
            return $next($request);
        }

        $request->getRouter()->redirect('/admin?status=denied');
    }
    /**
     * Limpa a url e separa a URI
     */
    private function getUri($request)
    {

        //URI
        $uri = $request->getUri();

        //Dividindo a uri
        $uri_parts = explode('/', $uri);

        //URI limpa
        $uri_str = $uri_parts[3];

        return $uri_str;
    }
}
