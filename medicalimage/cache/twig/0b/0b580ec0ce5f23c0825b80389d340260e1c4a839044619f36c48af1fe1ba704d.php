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

/* admin/setting_manage.html.twig */
class __TwigTemplate_3db5508516032c64fdba3f8225ebbb14ab9fc91d2bf6db06c15d747a7e74660f extends \Twig\Template
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
        return "admin/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/setting_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Site Settings";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "configuration";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "setting_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<script>
    \$(document).ready(function () {
        // ensure active menu is set to the system upgrade
        setSelectedMenuItemByUrl(\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_PROTOCOL"] ?? null), "html", null, true);
        echo "://";
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_HOST_URL"] ?? null), "html", null, true);
        echo twig_escape_filter($this->env, ($context["currentPageUrl"] ?? null), "html", null, true);
        echo "\");
    });
</script>

<div class=\"right_col\" role=\"main\">
    <div class=\"\">
        <div class=\"page-title\">
            <div class=\"title_left\">
                <h3>";
        // line 19
        echo twig_escape_filter($this->env, ($context["ADMIN_PAGE_TITLE"] ?? null), "html", null, true);
        echo "</h3>
            </div>
            <div class=\"title_right\">
                <div class=\"col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search\">
                    <form method=\"GET\" action=\"setting_manage\">
                        <div class=\"input-group\">
                            <select name=\"filterByGroup\" id=\"filterByGroup\" class=\"form-control\" onChange=\"\$(this).closest('form').trigger('submit');\">
                                <option value=\"\" DISABLED>- Other Settings -</option>
                                <option value=\"\">- Show All -</option>
                                ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groupListing"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["groupListingItem"]) {
            // line 29
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["groupListingItem"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["config_group"] ?? null) : null), "html", null, true);
            echo "\"
                                    ";
            // line 30
            if (((($context["filterByGroup"] ?? null) != null) && (($context["filterByGroup"] ?? null) == (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["groupListingItem"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["config_group"] ?? null) : null)))) {
                echo " SELECTED";
            }
            // line 31
            echo "                                    >";
            echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["groupListingItem"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["config_group"] ?? null) : null), "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['groupListingItem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "                            </select>
                            <span class=\"input-group-btn\">
                                <button class=\"btn btn-default\" type=\"submit\">Go!</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class=\"clearfix\"></div>

        ";
        // line 44
        echo ($context["msg_page_notifications"] ?? null);
        echo "

        <div class=\"row\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <form action=\"setting_manage";
        // line 48
        (((($context["filterByGroup"] ?? null) != null)) ? (print (twig_escape_filter($this->env, ("?filterByGroup=" . ($context["filterByGroup"] ?? null)), "html", null, true))) : (print ("")));
        echo "\" method=\"POST\" class=\"form-horizontal form-label-left\">
                    ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groupDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["groupDetail"]) {
            // line 50
            echo "                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>";
            // line 52
            echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = $context["groupDetail"]) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["config_group"] ?? null) : null), "html", null, true);
            echo "</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <br/>
                            ";
            // line 57
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["configItemElements"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4[(($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = $context["groupDetail"]) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["config_group"] ?? null) : null)] ?? null) : null));
            foreach ($context['_seq'] as $context["_key"] => $context["configItemElement"]) {
                // line 58
                echo "                            <div class=\"form-group\" style=\"margin-bottom: 0px;\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"username\">";
                // line 59
                echo twig_escape_filter($this->env, (($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = $context["configItemElement"]) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["label"] ?? null) : null), "html", null, true);
                echo "</label>
                                <div class=\"col-md-";
                // line 60
                echo twig_escape_filter($this->env, (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = $context["configItemElement"]) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["colSize"] ?? null) : null), "html", null, true);
                echo " col-sm-9 col-xs-12\">
                                ";
                // line 61
                echo (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = $context["configItemElement"]) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["elementHtml"] ?? null) : null);
                echo "
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\"></label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <p class=\"text-muted\">
                                        ";
                // line 68
                echo twig_escape_filter($this->env, (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = $context["configItemElement"]) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["description"] ?? null) : null), "html", null, true);
                echo "
                                    </p>
                                </div>
                            </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['configItemElement'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 73
            echo "                        </div>
                    </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['groupDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "                    
                    <div class=\"x_panel\">
                        <div class=\"x_content\">
                            
                            <div class=\"ln_solid\"></div>
                            <div class=\"form-group\">
                                <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                    <button type=\"button\" class=\"btn btn-default\" onClick=\"window.location = '";
        // line 83
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "';\">Cancel</button>
                                    <button type=\"submit\" class=\"btn btn-primary\">Update Settings</button>
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
        return "admin/setting_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  220 => 83,  211 => 76,  203 => 73,  192 => 68,  182 => 61,  178 => 60,  174 => 59,  171 => 58,  167 => 57,  159 => 52,  155 => 50,  151 => 49,  147 => 48,  140 => 44,  127 => 33,  118 => 31,  114 => 30,  109 => 29,  105 => 28,  93 => 19,  79 => 11,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/setting_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/setting_manage.html.twig");
    }
}
