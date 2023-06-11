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

/* account/index.html.twig */
class __TwigTemplate_1d2f913eaa0ca503ed5a4ce5d12789d3262a4c539d1b9d94c2326e30a085e449 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'description' => [$this, 'block_description'],
            'keywords' => [$this, 'block_keywords'],
            'selected_navigation_link' => [$this, 'block_selected_navigation_link'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "account/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/layout_logged_in.html.twig", "account/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, ($context["pageTitle"] ?? null), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_home_meta_description", "Your Account Home"), "html", null, true);
    }

    // line 5
    public function block_keywords($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_home_meta_keywords", "account, home, file, your, interface, upload, download, site"), "html", null, true);
    }

    // line 6
    public function block_selected_navigation_link($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "your_files";
    }

    // line 8
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 9
        if ((($context["initialFileId"] ?? null) == null)) {
            // line 10
            echo "    <script>
    \$(document).ready(function() {
        loadImages('";
            // line 12
            echo twig_escape_filter($this->env, ($context["pageType"] ?? null), "html", null, true);
            echo "', '";
            echo twig_escape_filter($this->env, ($context["initialLoadFolderId"] ?? null), "html", null, true);
            echo "', 1, 0, '', {'searchTerm': \"";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, ($context["searchTerm"] ?? null), "js"), "html", null, true);
            echo "\", 'filterUploadedDateRange': \"";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, ($context["filterUploadedDateRange"] ?? null), "js"), "html", null, true);
            echo "\"});
        console.log('";
            // line 13
            echo twig_escape_filter($this->env, ($context["pageType"] ?? null), "html", null, true);
            echo "', '";
            echo twig_escape_filter($this->env, ($context["initialLoadFolderId"] ?? null), "html", null, true);
            echo "', 1, 0, '', {'searchTerm': \"";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, ($context["searchTerm"] ?? null), "js"), "html", null, true);
            echo "\", 'filterUploadedDateRange': \"";
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, ($context["filterUploadedDateRange"] ?? null), "js"), "html", null, true);
            echo "\"});

        \$('a[data-toggle=\"tab\"]').on('shown.bs.tab', function (e) {
            // sometimes hidden image thumbnails don't get rendered correct, so fix
            fixImageBrowseHeights('#browse-images');
        });
    });
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "account/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 13,  88 => 12,  84 => 10,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/index.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/index.html.twig");
    }
}
