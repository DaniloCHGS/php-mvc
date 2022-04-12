<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Alert
{
    /**
     * Retorna mensagem de sucesso
     */
    public static function getSuccess($message)
    {
        return View::render("admin/alert/status", [
            'type' => 'success',
            'mensagem' => $message
        ]);
    }
    /**
     * Retorna mensagem de erro
     */
    public static function getError($message)
    {
        return View::render("admin/alert/status", [
            'type' => 'danger',
            'mensagem' => $message
        ]);
    }
}
