<?php

namespace Bellisq\Bellisq\MVC\Views;

use Bellisq\MVC\ViewAbstract;


class WelcomeView
    extends ViewAbstract
{
    /** @var string */
    private $message;

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function dispatch(): void
    {
        echo htmlspecialchars($this->message, ENT_QUOTES | ENT_HTML5);
    }
}