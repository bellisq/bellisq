<?php

namespace Bellisq\Bellisq\MVC\Controllers;

use Bellisq\Bellisq\MVC\Views\WelcomeView;
use Bellisq\MVC\ControllerAbstract;
use Bellisq\MVC\ViewAbstract;


class WelcomeController
    extends ControllerAbstract
{
    /** @var WelcomeView */
    private $view;

    public function __construct(WelcomeView $v)
    {
        $this->view = $v;
    }

    public function showWelcome(string $message): ViewAbstract
    {
        return $this->view->setMessage($message);
    }
}