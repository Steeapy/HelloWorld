<?php
declare (strict_types=1);

namespace HelloWorld\Service;

class View
{
    private string $template;

    public function __construct(string $template)
    {
        $this->template = TEMPLATE_ROOT . DIRECTORY_SEPARATOR . $template . '.php';

        if (!file_exists($this->template)) {
            throw new \RuntimeException('Template file not found');
        }
    }
    public function render(?array $data = null): string
    {
        if($data !== null) {
            extract($data);
        }

        ob_start();
            require_once $this->template;
            $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}