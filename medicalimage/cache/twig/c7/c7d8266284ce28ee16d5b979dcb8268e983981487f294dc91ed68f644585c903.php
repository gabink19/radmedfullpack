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

/* admin/theme_manage.html.twig */
class __TwigTemplate_761f501a88f7032e1d8f9ead765917627d2a2ba5c02dd8ba53b3ed99e1d3550e extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/theme_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Themes";
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
        echo "    <!-- page content -->
    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>";
        // line 13
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 18
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>Manage Themes</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <div class=\"row\">
                                ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["limitedRS"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 30
            echo "                                    <div class=\"col-md-6 col-sm-6 col-xs-12 profile_details\">
                                        <div class=\"well profile_view\">
                                            <div class=\"col-sm-12\">
                                                <h4 class=\"brief\"></h4>
                                                <div class=\"left col-xs-7\">
                                                    <h2>";
            // line 35
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["row"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["theme_name"] ?? null) : null), "html", null, true);
            echo ((((($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["row"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["folder_name"] ?? null) : null) == ($context["siteTheme"] ?? null))) ? ("&nbsp;&nbsp;<span style=\"color: green;\">(active)</a>") : (""));
            echo "</h2>
                                                    <p><strong>Description: </strong>";
            // line 36
            echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["row"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["theme_description"] ?? null) : null), "html", null, true);
            echo "</p>
                                                    <ul class=\"list-unstyled\">
                                                        <li><i class=\"fa fa-user\" title=\"author\"></i> ";
            // line 38
            echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = $context["row"]) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["author_name"] ?? null) : null), "html", null, true);
            echo (((twig_length_filter($this->env, (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = $context["row"]) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["author_website"] ?? null) : null)) > 0)) ? (((((" (<a href=\"" . (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = $context["row"]) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["author_website"] ?? null) : null)) . "\" target=\"_blank\">") . (($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = $context["row"]) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["author_website"] ?? null) : null)) . "</a>)")) : (""));
            echo "</li>
                                                        <li><i class=\"fa fa-folder-o\" title=\"folder\"></i> /";
            // line 39
            echo twig_escape_filter($this->env, (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = $context["row"]) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["folder_name"] ?? null) : null), "html", null, true);
            echo "</li>
                                                    </ul>
                                                </div>
                                                <div class=\"right col-xs-5 text-center\">
                                                    <img src=\"";
            // line 43
            echo twig_escape_filter($this->env, ($context["SITE_THEME_WEB_ROOT"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = $context["row"]) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["folder_name"] ?? null) : null), "html", null, true);
            echo "/thumb_preview.png\" class=\"img-square img-responsive pull-right\" style=\"width: 100%;\"/>
                                                </div>
                                            </div>
                                            <div class=\"col-xs-12 bottom text-center\">
                                                <div class=\"col-xs-12 col-sm-12 emphasis\">
                                                    ";
            // line 48
            if (((($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = $context["row"]) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["folder_name"] ?? null) : null) != ($context["siteTheme"] ?? null))) {
                // line 49
                echo "                                                        <a type=\"button\" class=\"btn btn-disabled\" href=\"";
                echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
                echo "/theme_manage?delete=";
                echo twig_escape_filter($this->env, (($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = $context["row"]) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["folder_name"] ?? null) : null), "html", null, true);
                echo "\" onClick=\"return confirm('Are you sure that you want to completely delete the theme files from the server.');\">
                                                            <i class=\"fa fa-trash\"> </i> Remove
                                                        </a>
                                                    ";
            }
            // line 53
            echo "
                                                    ";
            // line 54
            if ((twig_length_filter($this->env, (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = $context["row"]) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae["settingsPath"] ?? null) : null)) > 0)) {
                // line 55
                echo "                                                        <a type=\"button\" class=\"btn btn-primary\" href=\"";
                echo twig_escape_filter($this->env, (($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = $context["row"]) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f["settingsPath"] ?? null) : null), "html", null, true);
                echo "\">
                                                            <i class=\"fa fa-cogs\"> </i> Settings
                                                        </a>
                                                    ";
            }
            // line 59
            echo "

                                                    ";
            // line 61
            if (((($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = $context["row"]) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40["folder_name"] ?? null) : null) != ($context["siteTheme"] ?? null))) {
                // line 62
                echo "                                                        <a type=\"button\" class=\"btn btn-default\" onClick=\"return confirm('This will set your current logged in session to use this theme, switch back by logging out or by clicking the preview for the original on this page.');\" href=\"";
                echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
                echo "/theme_preview/";
                echo twig_escape_filter($this->env, (($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = $context["row"]) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f["folder_name"] ?? null) : null), "html", null, true);
                echo "\" target=\"_blank\">
                                                            <i class=\"fa fa-search-plus\"> </i> Preview
                                                        </a>

                                                        <a type=\"button\" class=\"btn btn-success\" onClick=\"return confirm('Are you sure you want to enable this theme? The website will be immediately updated.');\" href=\"theme_manage?activate=";
                // line 66
                echo twig_escape_filter($this->env, (($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = $context["row"]) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760["folder_name"] ?? null) : null), "html", null, true);
                echo "\">
                                                            <i class=\"fa fa-check\"> </i> Activate
                                                        </a>
                                                    ";
            }
            // line 70
            echo "                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "                            </div>
                        </div>
                    </div>

                    <div class=\"x_panel\">
                        <a href=\"theme_manage_add\" type=\"button\" class=\"btn btn-primary\">Add Theme</a>
                        <a href=\"";
        // line 81
        echo twig_escape_filter($this->env, ($context["currentProductUrl"] ?? null), "html", null, true);
        echo "/themes.html\" target=\"_blank\" type=\"button\" class=\"btn btn-default\">Get Themes</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/theme_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  211 => 81,  203 => 75,  193 => 70,  186 => 66,  176 => 62,  174 => 61,  170 => 59,  162 => 55,  160 => 54,  157 => 53,  147 => 49,  145 => 48,  136 => 43,  129 => 39,  124 => 38,  119 => 36,  114 => 35,  107 => 30,  103 => 29,  89 => 18,  81 => 13,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/theme_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/theme_manage.html.twig");
    }
}
