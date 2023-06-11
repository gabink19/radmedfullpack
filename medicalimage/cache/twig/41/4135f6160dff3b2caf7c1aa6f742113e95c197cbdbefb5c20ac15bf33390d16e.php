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

/* admin/theme_settings.html.twig */
class __TwigTemplate_b4d78a6b285386e0254069b686377909ddb2931f051bef92b1c69cc8e3cd1d1b extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'selected_page' => [$this, 'block_selected_page'],
            'selected_sub_page' => [$this, 'block_selected_sub_page'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@core/admin/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("@core/admin/partial/layout_logged_in.html.twig", "admin/theme_settings.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Theme Settings";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "themes";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "theme_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<div class=\"row clearfix\">
    <div class=\"col_12\">
        <div class=\"widget clearfix\">
            <h2>Settings</h2>
            <div class=\"widget_inside\">
                
                ";
        // line 14
        echo ($context["msg_page_notifications"] ?? null);
        echo "
                
                <form method=\"POST\" action=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/theme_settings/evolution\" name=\"pluginForm\" id=\"pluginForm\" autocomplete=\"off\" enctype=\"multipart/form-data\">

                    <div class=\"clearfix col_12\">
                        <div class=\"col_4\">
                            <h3>General Site Settings</h3>
                            <p>Site logo, skin and any other settings.</p>
                        </div>
                        <div class=\"col_8 last\">
                            <div class=\"form\">
                                <div class=\"clearfix alt-highlight\">
                                    <label>Main Site Logo:</label>
                                    <div class=\"input\">
                                        <input type=\"file\" name=\"site_logo\"/>
                                        Shown on the login screen &amp; file manager, generally on a dark background. Leave blank to keep existing. Must be a transparent png. Download the <a href=\"../images/logo/logo.png\" target=\"_blank\" download>original png here</a>.
                                        <br/>
                                        <br/>
                                        <img src=\"";
        // line 32
        echo twig_escape_filter($this->env, ($context["mainLogoUrl"] ?? null), "html", null, true);
        echo "?r=";
        echo twig_escape_filter($this->env, twig_random($this->env, 999999), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"clearfix\">
                                    <label>Public Shared Logo:</label>
                                    <div class=\"input\">
                                        <input type=\"file\" name=\"site_logo_inverted\"/>
                                        Shown on the share folder pages, on a white background. Leave blank to keep existing. Must be a transparent png. Download the <a href=\"../images/logo/logo-whitebg.png\" target=\"_blank\" download>original png here</a>.
                                        <br/>
                                        <br/>
                                        <div class=\"image-hover\">
                                            <img src=\"";
        // line 44
        echo twig_escape_filter($this->env, ($context["inverseLogoUrl"] ?? null), "html", null, true);
        echo "?r=";
        echo twig_escape_filter($this->env, twig_random($this->env, 999999), "html", null, true);
        echo "\"/>
                                        </div>
                                    </div>
                                </div>

                                <div class=\"clearfix alt-highlight\">
                                    <label>Site Skin:</label>
                                    <div class=\"input\">
                                        <select name=\"site_skin\" id=\"site_skin\" class=\"medium\">
                                            ";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["skinsArr"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["skin"]) {
            // line 54
            echo "                                                <option";
            echo (((($context["site_skin"] ?? null) == $context["skin"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, $context["skin"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['skin'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"clearfix\">
                                    <label>Custom CSS Code:</label>
                                    <div class=\"input\">
                                        <textarea name=\"css_code\" class=\"xxlarge\" placeholder=\"css code...\" style=\"font-family: monospace; height: 200px;\">";
        // line 63
        echo twig_escape_filter($this->env, ($context["css_code"] ?? null), "html", null, true);
        echo "</textarea>
                                        Optional. Use this field to override any of the site CSS without having to create a new theme. By right clicking on an element in your browser and selecting 'inspect', you can find the relating CSS rules. These changes will be kept after any script upgrades.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"clearfix col_12\">
                        <div class=\"col_4 adminResponsiveHide\">&nbsp;</div>
                        <div class=\"col_8 last\">
                            <div class=\"clearfix\">
                                <div class=\"input no-label\">
                                    <input type=\"submit\" value=\"Submit\" class=\"button blue\">
                                    <input type=\"reset\" value=\"Cancel\" class=\"button\" onClick=\"window.location = '";
        // line 77
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/theme_manage';\"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input name=\"submitted\" type=\"hidden\" value=\"1\"/>
                </form>
            </div>
        </div>   
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin/theme_settings.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 77,  161 => 63,  152 => 56,  141 => 54,  137 => 53,  123 => 44,  106 => 32,  87 => 16,  82 => 14,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/theme_settings.html.twig", "/var/www/html/medicalimage/themes/evolution/views/admin/theme_settings.html.twig");
    }
}
