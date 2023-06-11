<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* error/404.html.twig */
class __TwigTemplate_a34ce7a754f1e33b0b73f01de24d85c596bf260124863c083bb2d7a9b27d7045 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">
    <head>
        <title>404 - Page Not Found</title><style>
            html, body {
                margin:\t0;
                padding: 0;
                font-family: \"Lucida Grande\", Helvetica, Arial, \"Arial Unicode\", sans-serif;
                font-size: 20px;
                color: #c3c3c3;
                height:\t100%;
            }
            
            .mainContent
            {
                width: 100%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                position: absolute;
                top: 25%;
                height: 100px;
            }

            h1 {
                color: #dadada;
                font-size: 190px;
                line-height: 0px;
            }
            
            .text404 {
                margin-top: -24px;
                margin-bottom: 42px;
            }
            
            a {
                text-decoration: underline;
                color: #c3c3c3;
            }
            
            a:hover {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class=\"mainContent\">
            <h1>404</h1>
            <p class=\"text404\">Oops - Page Not Found!</p>
            <p><a href=\"";
        // line 50
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "\">Home</a></p>
        </div>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "error/404.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 50,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "error/404.html.twig", "/var/www/html/medicalimage/app/views/error/404.html.twig");
    }
}
