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

/* admin/support_info.html.twig */
class __TwigTemplate_b547e52cd48ec535a81ced9687d34e5f10e02b29c9dafa426b900446d0c996dc extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/support_info.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Support Information";
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
        echo "support_info";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>Support Information</h3><div class=\"clearfix\"></div>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 17
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            ";
        // line 19
        if ((twig_length_filter($this->env, ($context["msg_page_notifications"] ?? null)) == 0)) {
            // line 20
            echo "                <div class=\"row\">
                    <div class=\"col-md-12 col-sm-12 col-xs-12\">
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Support File</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>When requiring support, please click the \"Download\" button below and attach it to your support ticket.</p>
                                <table class=\"table table-data-list\"><tbody>
                                        <tr>
                                            <td>Support File:</td>
                                            <td><a href=\"support_info_download\" name=\"supportInfo\" class=\"btn btn-primary\" style=\"margin-bottom: 0px;\">Download</button></td>
                                        </tr>                            
                                    </tbody></table>
                            </div>                       
                        </div> 

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Server Information</h2><div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <table class=\"table table-data-list\">
                                    <tbody>
                                        <tr>
                                            <td>Operating System:</td>
                                            <td>";
            // line 47
            echo twig_escape_filter($this->env, ($context["operatingSystem"] ?? null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Web Server:</td>
                                            <td>";
            // line 51
            echo twig_escape_filter($this->env, (((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["server"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["SERVER_SIGNATURE"] ?? null) : null)) ? ((($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["server"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["SERVER_SIGNATURE"] ?? null) : null)) : ((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["server"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["SERVER_SOFTWARE"] ?? null) : null))), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Server Hostname:</td>
                                            <td>";
            // line 55
            echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["server"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["HTTP_HOST"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Server IP Address:</td>
                                            <td>";
            // line 59
            echo twig_escape_filter($this->env, (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["server"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["SERVER_ADDR"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Server Time:</td>
                                            <td>";
            // line 63
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["dt"] ?? null), "format", [0 => "d-m-Y H:i:s"], "method", false, false, false, 63), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Document Root:</td>
                                            <td>";
            // line 67
            echo twig_escape_filter($this->env, (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = ($context["server"] ?? null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["DOCUMENT_ROOT"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                        
                        </div>

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>MySQL Information</h2><div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <table class=\"table table-data-list\"><tbody>
                                        <tr>
                                            <td>MySQL Client Version:</td>
                                            <td>";
            // line 82
            echo twig_escape_filter($this->env, (($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["phparr"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["mysqli"] ?? null) : null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["Client API library version"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>MySQL Server Version:</td>
                                            <td>";
            // line 86
            echo twig_escape_filter($this->env, ($context["mysqlServerVersion"] ?? null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>MySQL Server Time:</td>
                                            <td>";
            // line 90
            echo twig_escape_filter($this->env, ($context["mysqlServerTime"] ?? null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>PDO Installed:</td>
                                            <td>";
            // line 94
            echo twig_escape_filter($this->env, (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = ($context["phparr"] ?? null)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["PDO"] ?? null) : null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["PDO drivers"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>PDO Version:</td>
                                            <td>";
            // line 98
            echo twig_escape_filter($this->env, (($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = ($context["phparr"] ?? null)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae["pdo_mysql"] ?? null) : null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["Client API version"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                    </tbody></table>
                            </div>                        
                        </div>  
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>PHP Information</h2><div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <table class=\"table table-data-list\"><tbody>
                                        <tr>
                                            <td>PHP Version:</td>
                                            <td>";
            // line 111
            echo twig_escape_filter($this->env, ($context["phpVersion"] ?? null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>php.ini Location:</td>
                                            <td>";
            // line 115
            echo twig_escape_filter($this->env, ($context["phpLoadedIniFile"] ?? null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Current PHP Time:</td>
                                            <td>";
            // line 119
            echo twig_escape_filter($this->env, ($context["phpCurrentTime"] ?? null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Max Execution Time:</td>
                                            <td>";
            // line 123
            echo twig_escape_filter($this->env, (($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = (($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = ($context["phparr"] ?? null)) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40["Core"] ?? null) : null)) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f["max_execution_time"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Max Input Time:</td>
                                            <td>";
            // line 127
            echo twig_escape_filter($this->env, (($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = (($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = ($context["phparr"] ?? null)) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760["Core"] ?? null) : null)) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f["max_input_time"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Memory Limit:</td>
                                            <td>";
            // line 131
            echo twig_escape_filter($this->env, (($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce = (($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b = ($context["phparr"] ?? null)) && is_array($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b) || $__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b instanceof ArrayAccess ? ($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b["Core"] ?? null) : null)) && is_array($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce) || $__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce instanceof ArrayAccess ? ($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce["memory_limit"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Post Max Size:</td>
                                            <td>";
            // line 135
            echo twig_escape_filter($this->env, (($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c = (($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 = ($context["phparr"] ?? null)) && is_array($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972) || $__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 instanceof ArrayAccess ? ($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972["Core"] ?? null) : null)) && is_array($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c) || $__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c instanceof ArrayAccess ? ($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c["post_max_size"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Upload Max Filesize:</td>
                                            <td>";
            // line 139
            echo twig_escape_filter($this->env, (($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 = (($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 = ($context["phparr"] ?? null)) && is_array($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0) || $__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 instanceof ArrayAccess ? ($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0["Core"] ?? null) : null)) && is_array($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216) || $__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 instanceof ArrayAccess ? ($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216["upload_max_filesize"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>cURL Enabled:</td>
                                            <td>";
            // line 143
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c = (($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f = ($context["phparr"] ?? null)) && is_array($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f) || $__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f instanceof ArrayAccess ? ($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f["curl"] ?? null) : null)) && is_array($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c) || $__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c instanceof ArrayAccess ? ($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c["cURL support"] ?? null) : null)), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>cURL Version:</td>
                                            <td>";
            // line 147
            echo twig_escape_filter($this->env, (($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc = (($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 = ($context["phparr"] ?? null)) && is_array($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55) || $__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 instanceof ArrayAccess ? ($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55["curl"] ?? null) : null)) && is_array($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc) || $__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc instanceof ArrayAccess ? ($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc["cURL Information"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Default Timezone:</td>
                                            <td>";
            // line 151
            echo twig_escape_filter($this->env, (($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba = (($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 = ($context["phparr"] ?? null)) && is_array($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78) || $__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 instanceof ArrayAccess ? ($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78["date"] ?? null) : null)) && is_array($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba) || $__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba instanceof ArrayAccess ? ($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba["Default timezone"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>GD Enabled:</td>
                                            <td>";
            // line 155
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de = (($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 = ($context["phparr"] ?? null)) && is_array($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828) || $__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 instanceof ArrayAccess ? ($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828["gd"] ?? null) : null)) && is_array($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de) || $__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de instanceof ArrayAccess ? ($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de["GD Support"] ?? null) : null)), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>OpenSSL Details:</td>
                                            <td>";
            // line 159
            echo twig_escape_filter($this->env, ($context["openSSLDetails"] ?? null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Default Timezone:</td>
                                            <td>";
            // line 163
            echo twig_escape_filter($this->env, (($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd = (($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 = ($context["phparr"] ?? null)) && is_array($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6) || $__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 instanceof ArrayAccess ? ($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6["date"] ?? null) : null)) && is_array($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd) || $__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd instanceof ArrayAccess ? ($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd["Default timezone"] ?? null) : null), "html", null, true);
            echo "</td>
                                        </tr>
                                        <tr>
                                            <td>Loaded Extensions:</td>
                                            <td>
                                                <select name=\"\" id=\"\" class=\"form-control\" MULTIPLE>
                                                    ";
            // line 169
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["loadedExtensions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["loadedExtension"]) {
                // line 170
                echo "                                                        <option value=\"\">";
                echo twig_escape_filter($this->env, $context["loadedExtension"], "html", null, true);
                echo "</option>
                                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['loadedExtension'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 172
            echo "                                                </select>                                    
                                            </td>
                                        </tr>                              
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>   
            ";
        }
        // line 182
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/support_info.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  343 => 182,  331 => 172,  322 => 170,  318 => 169,  309 => 163,  302 => 159,  295 => 155,  288 => 151,  281 => 147,  274 => 143,  267 => 139,  260 => 135,  253 => 131,  246 => 127,  239 => 123,  232 => 119,  225 => 115,  218 => 111,  202 => 98,  195 => 94,  188 => 90,  181 => 86,  174 => 82,  156 => 67,  149 => 63,  142 => 59,  135 => 55,  128 => 51,  121 => 47,  92 => 20,  90 => 19,  85 => 17,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/support_info.html.twig", "/var/www/html/medicalimage/app/views/admin/support_info.html.twig");
    }
}
