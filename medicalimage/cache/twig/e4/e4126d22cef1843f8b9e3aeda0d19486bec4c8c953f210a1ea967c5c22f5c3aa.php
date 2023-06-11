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

/* account/partial/layout_non_login.html.twig */
class __TwigTemplate_d10583c131a358123f96a2d182c6d7c03488e96a0e4c33a7089cf0965b283af3 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\" dir=\"";
        // line 2
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, ($context["SITE_LANGUAGE_DIRECTION"] ?? null)), "html", null, true);
        echo "\" class=\"direction";
        echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, ($context["SITE_LANGUAGE_DIRECTION"] ?? null)), "html", null, true);
        echo " ";
        if (        $this->hasBlock("html_element_class", $context, $blocks)) {
            $this->displayBlock("html_element_class", $context, $blocks);
        }
        echo "\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
        <title>";
        // line 7
        $this->displayBlock("title", $context, $blocks);
        echo " - ";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "</title>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
        <meta name=\"description\" content=\"";
        // line 9
        $this->displayBlock("description", $context, $blocks);
        echo "\" />
        <meta name=\"keywords\" content=\"";
        // line 10
        $this->displayBlock("keywords", $context, $blocks);
        echo "\" />
        <meta name=\"copyright\" content=\"Copyright &copy; - ";
        // line 11
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\" />
        <meta name=\"robots\" content=\"all\" />
        <meta http-equiv=\"Cache-Control\" content=\"no-cache\" />
        <meta http-equiv=\"Expires\" content=\"-1\" />
        <meta http-equiv=\"Pragma\" content=\"no-cache\" />

        <!-- og meta tags -->
        ";
        // line 18
        if ((isset($context["PAGE_OG_TITLE"]) || array_key_exists("PAGE_OG_TITLE", $context))) {
            // line 19
            echo "            <meta property=\"og:title\" content=\"";
            echo twig_escape_filter($this->env, ($context["PAGE_OG_TITLE"] ?? null), "html", null, true);
            echo "\" />
        ";
        }
        // line 21
        echo "        ";
        if ((isset($context["PAGE_OG_IMAGE"]) || array_key_exists("PAGE_OG_IMAGE", $context))) {
            // line 22
            echo "            <meta property=\"og:image\" content=\"";
            echo twig_escape_filter($this->env, ($context["PAGE_OG_IMAGE"] ?? null), "html", null, true);
            echo ">\" />
        ";
        } else {
            // line 24
            echo "            <meta property=\"og:image\" content=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 24), "html", null, true);
            echo "/favicon/ms-icon-144x144.png\" />
        ";
        }
        // line 26
        echo "        <meta property=\"og:type\" content=\"website\" />

        <!-- fav and touch icons -->
        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 29), "html", null, true);
        echo "/favicon/favicon.ico\" />
        <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 30), "html", null, true);
        echo "/favicon/favicon-96x96.png\">
        <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 31), "html", null, true);
        echo "/favicon/apple-icon-152x152.png\">
        <link rel=\"manifest\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 32), "html", null, true);
        echo "/favicon/manifest.json\">
        <meta name=\"msapplication-TileImage\" content=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 33), "html", null, true);
        echo "/favicon/ms-icon-144x144.png\">
        <meta name=\"msapplication-TileColor\" content=\"#ffffff\">
        <meta name=\"theme-color\" content=\"#ffffff\">

        <link rel=\"stylesheet\" href=\"";
        // line 37
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 37), "html", null, true);
        echo "/fonts.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 38), "html", null, true);
        echo "/font-icons/entypo/css/entypo.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 39
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 39), "html", null, true);
        echo "/font-icons/font-awesome/css/font-awesome.min.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 40
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 40), "html", null, true);
        echo "/bootstrap.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 41
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 41), "html", null, true);
        echo "/zsocial.css\"/>
        ";
        // line 42
        if ((twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getThemeSkin", [], "method", false, false, false, 42) != false)) {
            // line 43
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 43), "html", null, true);
            echo "/skins/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getThemeSkin", [], "method", false, false, false, 43), "html", null, true);
            echo "\" />
        ";
        } else {
            // line 45
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 45), "html", null, true);
            echo "/skins/default.css\" />
        ";
        }
        // line 47
        echo "        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 47), "html", null, true);
        echo "/core.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 48
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 48), "html", null, true);
        echo "/theme.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 49
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 49), "html", null, true);
        echo "/forms.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 50
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 50), "html", null, true);
        echo "/responsive.css\" />
        ";
        // line 51
        if ((($context["SITE_LANGUAGE_DIRECTION"] ?? null) == "RTL")) {
            // line 52
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 52), "html", null, true);
            echo "/rtl.css\" />
        ";
        }
        // line 54
        echo "        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 54), "html", null, true);
        echo "/daterangepicker-bs3.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 55
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 55), "html", null, true);
        echo "/custom.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 56
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 56), "html", null, true);
        echo "/file-upload.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 57
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 57), "html", null, true);
        echo "/search_widget.css\" />
        <link rel=\"stylesheet\" type=\"text/css\"  href=\"";
        // line 58
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/filepreviewer/assets/players/ultimate/content/global.css\"/>
        ";
        // line 59
        echo twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "outputCustomCSSCode", [], "method", false, false, false, 59);
        echo "

        <script src=\"";
        // line 61
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 61), "html", null, true);
        echo "/jquery-1.11.0.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 62), "html", null, true);
        echo "/jquery.ckie.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 63
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 63), "html", null, true);
        echo "/jquery.jstree.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 64
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 64), "html", null, true);
        echo "/jquery.event.drag-2.2.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 65
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 65), "html", null, true);
        echo "/jquery.event.drag.live-2.2.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 66
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 66), "html", null, true);
        echo "/jquery.event.drop-2.2.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 67
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 67), "html", null, true);
        echo "/jquery.event.drop.live-2.2.js\"></script>

        <link rel=\"stylesheet\" href=\"";
        // line 69
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 69), "html", null, true);
        echo "/file_browser_sprite_48px.css\" type=\"text/css\" charset=\"utf-8\" />

        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 71
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 71), "html", null, true);
        echo "/slick/slick.css\"/>

        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 73
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 73), "html", null, true);
        echo "/slick/slick-theme.css\"/>
        <script type=\"text/javascript\" src=\"";
        // line 74
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 74), "html", null, true);
        echo "/slick/slick.js\"></script>

        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 76
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 76), "html", null, true);
        echo "/photo-swipe/photoswipe.css\"/>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 77
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 77), "html", null, true);
        echo "/photo-swipe/default-skin/default-skin.css\"/>
        <script type=\"text/javascript\" src=\"";
        // line 78
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 78), "html", null, true);
        echo "/photo-swipe/photoswipe.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 79
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 79), "html", null, true);
        echo "/photo-swipe/photoswipe-ui-default.min.js\"></script>

        <!-- mobile swipe navigation -->
        <script type=\"text/javascript\" src=\"";
        // line 82
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 82), "html", null, true);
        echo "/jquery.touchSwipe.min.js\"></script>

        <script type=\"text/javascript\" src=\"";
        // line 84
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 84), "html", null, true);
        echo "/evolution.js\"></script>

        <!--[if lt IE 9]><script src=\"";
        // line 86
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 86), "html", null, true);
        echo "/ie8-responsive-file-warning.js\"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
                <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->

        <script type=\"text/javascript\">
            var ACCOUNT_WEB_ROOT = \"";
        // line 95
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 95), "html", null, true);
        echo "\";
            var SITE_THEME_WEB_ROOT = \"";
        // line 96
        echo twig_escape_filter($this->env, ($context["SITE_THEME_WEB_ROOT"] ?? null), "html", null, true);
        echo "\";
            var SITE_CSS_PATH = \"";
        // line 97
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 97), "html", null, true);
        echo "\";
            var SITE_IMAGE_PATH = \"";
        // line 98
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 98), "html", null, true);
        echo "\";
            var _CONFIG_SITE_PROTOCOL = \"";
        // line 99
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_PROTOCOL"] ?? null), "html", null, true);
        echo "\";
            var CORE_AJAX_WEB_ROOT = \"";
        // line 100
        echo twig_escape_filter($this->env, ($context["CORE_AJAX_WEB_ROOT"] ?? null), "html", null, true);
        echo "\";
            var LOGGED_IN = ";
        // line 101
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 101) == "true")) {
            echo "true";
        } else {
            echo "false";
        }
        echo ";
        </script>
        <script type=\"text/javascript\" src=\"";
        // line 103
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/js/translations.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 104
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 104), "html", null, true);
        echo "/jquery-ui.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 105
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 105), "html", null, true);
        echo "/jquery.dataTables.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 106
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 106), "html", null, true);
        echo "/jquery.tmpl.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 107
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 107), "html", null, true);
        echo "/load-image.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 108
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 108), "html", null, true);
        echo "/canvas-to-blob.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 109
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 109), "html", null, true);
        echo "/jquery.iframe-transport.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 110
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 110), "html", null, true);
        echo "/jquery.fileupload.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 111
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 111), "html", null, true);
        echo "/jquery.fileupload-process.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 112
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 112), "html", null, true);
        echo "/jquery.fileupload-resize.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 113
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 113), "html", null, true);
        echo "/jquery.fileupload-validate.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 114
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 114), "html", null, true);
        echo "/jquery.fileupload-ui.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 115
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 115), "html", null, true);
        echo "/zeroClipboard/ZeroClipboard.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 116
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 116), "html", null, true);
        echo "/daterangepicker/moment.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 117
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 117), "html", null, true);
        echo "/daterangepicker/daterangepicker.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 118
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 118), "html", null, true);
        echo "/charts/Chart.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 119
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/filepreviewer/assets/players/ultimate/java/FWDUVPlayer.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 120
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 120), "html", null, true);
        echo "/global.js\"></script>
    </head>
";
        // line 122
        $this->displayBlock('body', $context, $blocks);
        // line 123
        echo "</html>";
    }

    // line 122
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "account/partial/layout_non_login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  418 => 122,  414 => 123,  412 => 122,  407 => 120,  403 => 119,  399 => 118,  395 => 117,  391 => 116,  387 => 115,  383 => 114,  379 => 113,  375 => 112,  371 => 111,  367 => 110,  363 => 109,  359 => 108,  355 => 107,  351 => 106,  347 => 105,  343 => 104,  339 => 103,  330 => 101,  326 => 100,  322 => 99,  318 => 98,  314 => 97,  310 => 96,  306 => 95,  294 => 86,  289 => 84,  284 => 82,  278 => 79,  274 => 78,  270 => 77,  266 => 76,  261 => 74,  257 => 73,  252 => 71,  247 => 69,  242 => 67,  238 => 66,  234 => 65,  230 => 64,  226 => 63,  222 => 62,  218 => 61,  213 => 59,  209 => 58,  205 => 57,  201 => 56,  197 => 55,  192 => 54,  186 => 52,  184 => 51,  180 => 50,  176 => 49,  172 => 48,  167 => 47,  161 => 45,  153 => 43,  151 => 42,  147 => 41,  143 => 40,  139 => 39,  135 => 38,  131 => 37,  124 => 33,  120 => 32,  116 => 31,  112 => 30,  108 => 29,  103 => 26,  97 => 24,  91 => 22,  88 => 21,  82 => 19,  80 => 18,  70 => 11,  66 => 10,  62 => 9,  55 => 7,  41 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/layout_non_login.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/layout_non_login.html.twig");
    }
}
