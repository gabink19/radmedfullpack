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

/* login_login_box.html.twig */
class __TwigTemplate_99c67c93e1cf682f94ae3785fd9faa75dd4bbbff4fda430fac5f3f272e1093d8 extends \Twig\Template
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
        echo "<div class=\"pluginSocialMainLoginWrapper\">
    <div class=\"pluginSocialLoginDivider\">
        &nbsp;
    </div>
    <div class=\"clear\"><!-- --></div>

    <div id=\"pageHeader\">
        <h2>";
        // line 8
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("plugin_sociallogin_social_login", "Social Login"), "html", null, true);
        echo "</h2>
    </div>
    <div>
        <p class=\"introText\">
            ";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("plugin_sociallogin_social_login_intro_text", "Use your existing social network account to login securely below."), "html", null, true);
        echo "
        </p>

        <div class=\"pluginSocialLoginSignin\">
            <span class=\"fieldWrapper\">
                <span class=\"field-name\">&nbsp;</span>
                <div class=\"clear\"><!-- --></div>
                <div class=\"pluginSocialLoginButtons\">
                    ";
        // line 20
        if (((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["pluginSettings"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["facebook_enabled"] ?? null) : null) == 1)) {
            // line 21
            echo "                        <a href=\"";
            echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["pluginConfig"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["folder_name"] ?? null) : null), "html", null, true);
            echo "/login/Facebook\" class=\"zocial facebook\"><span>Sign in with Facebook</span></a>
                    ";
        }
        // line 23
        echo "                    
                    ";
        // line 24
        if (((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["pluginSettings"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["twitter_enabled"] ?? null) : null) == 1)) {
            // line 25
            echo "                        <a href=\"";
            echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["pluginConfig"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["folder_name"] ?? null) : null), "html", null, true);
            echo "/login/Twitter\" class=\"zocial twitter\"><span>Sign in with Twitter</span></a>
                    ";
        }
        // line 27
        echo "                    
                    ";
        // line 28
        if (((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["pluginSettings"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["google_enabled"] ?? null) : null) == 1)) {
            // line 29
            echo "                        <a href=\"";
            echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = ($context["pluginConfig"] ?? null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["folder_name"] ?? null) : null), "html", null, true);
            echo "/login/Google\" class=\"zocial google\"><span>Sign in with Google</span></a>
                    ";
        }
        // line 31
        echo "                    
                    ";
        // line 32
        if (((($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = ($context["pluginSettings"] ?? null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["foursquare_enabled"] ?? null) : null) == 1)) {
            // line 33
            echo "                        <a href=\"";
            echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["pluginConfig"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["folder_name"] ?? null) : null), "html", null, true);
            echo "/login/Foursquare\" class=\"zocial foursquare\"><span>Sign in with Foursquare</span></a>
                    ";
        }
        // line 35
        echo "                    
                    ";
        // line 36
        if (((($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = ($context["pluginSettings"] ?? null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["linkedin_enabled"] ?? null) : null) == 1)) {
            // line 37
            echo "                        <a href=\"";
            echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = ($context["pluginConfig"] ?? null)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["folder_name"] ?? null) : null), "html", null, true);
            echo "/login/LinkedIn\" class=\"zocial linkedin\"><span>Sign in with LinkedIn</span></a>
                    ";
        }
        // line 39
        echo "                    <div class=\"clear\"><!-- --></div>
                </div>
            </span>
            <div class=\"clear\"><!-- --></div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "login_login_box.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 39,  118 => 37,  116 => 36,  113 => 35,  105 => 33,  103 => 32,  100 => 31,  92 => 29,  90 => 28,  87 => 27,  79 => 25,  77 => 24,  74 => 23,  66 => 21,  64 => 20,  53 => 12,  46 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "login_login_box.html.twig", "/var/www/html/medicalimage/plugins/sociallogin/views/login_login_box.html.twig");
    }
}
