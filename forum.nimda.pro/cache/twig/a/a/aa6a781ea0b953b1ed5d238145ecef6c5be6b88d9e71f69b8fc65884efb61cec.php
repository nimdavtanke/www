<?php

/* acp_captcha.html */
class __TwigTemplate_aa6a781ea0b953b1ed5d238145ecef6c5be6b88d9e71f69b8fc65884efb61cec extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "acp_captcha.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb')->lang("ACP_VC_SETTINGS");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb')->lang("ACP_VC_SETTINGS_EXPLAIN");
        echo "</p>

<p>";
        // line 9
        echo $this->env->getExtension('phpbb')->lang("ACP_VC_EXT_GET_MORE");
        echo "</p>

<form id=\"acp_captcha\" method=\"post\" action=\"";
        // line 11
        echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
        echo "\">

<fieldset>
<legend>";
        // line 14
        echo $this->env->getExtension('phpbb')->lang("GENERAL_OPTIONS");
        echo "</legend>

<dl>
\t<dt><label for=\"enable_confirm\">";
        // line 17
        echo $this->env->getExtension('phpbb')->lang("VISUAL_CONFIRM_REG");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("VISUAL_CONFIRM_REG_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"enable_confirm\" name=\"enable_confirm\" value=\"1\"";
        // line 18
        if ((isset($context["REG_ENABLE"]) ? $context["REG_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("ENABLED");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_confirm\" value=\"0\"";
        // line 19
        if ( !(isset($context["REG_ENABLE"]) ? $context["REG_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("DISABLED");
        echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"max_reg_attempts\">";
        // line 22
        echo $this->env->getExtension('phpbb')->lang("REG_LIMIT");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("REG_LIMIT_EXPLAIN");
        echo "</span></dt>
\t<dd><input id=\"max_reg_attempts\" type=\"number\" size=\"4\" maxlength=\"4\" min=\"0\" max=\"9999\" name=\"max_reg_attempts\" value=\"";
        // line 23
        echo (isset($context["REG_LIMIT"]) ? $context["REG_LIMIT"] : null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"max_login_attempts\">";
        // line 26
        echo $this->env->getExtension('phpbb')->lang("MAX_LOGIN_ATTEMPTS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("MAX_LOGIN_ATTEMPTS_EXPLAIN");
        echo "</span></dt>
\t<dd><input id=\"max_login_attempts\" type=\"number\" size=\"4\" maxlength=\"4\" min=\"0\" max=\"9999\" name=\"max_login_attempts\" value=\"";
        // line 27
        echo (isset($context["MAX_LOGIN_ATTEMPTS"]) ? $context["MAX_LOGIN_ATTEMPTS"] : null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"enable_post_confirm\">";
        // line 30
        echo $this->env->getExtension('phpbb')->lang("VISUAL_CONFIRM_POST");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("VISUAL_CONFIRM_POST_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"enable_post_confirm\" name=\"enable_post_confirm\" value=\"1\"";
        // line 31
        if ((isset($context["POST_ENABLE"]) ? $context["POST_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("ENABLED");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_post_confirm\" value=\"0\"";
        // line 32
        if ( !(isset($context["POST_ENABLE"]) ? $context["POST_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("DISABLED");
        echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"confirm_refresh\">";
        // line 35
        echo $this->env->getExtension('phpbb')->lang("VISUAL_CONFIRM_REFRESH");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("VISUAL_CONFIRM_REFRESH_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"confirm_refresh\" name=\"confirm_refresh\" value=\"1\"";
        // line 36
        if ((isset($context["CONFIRM_REFRESH"]) ? $context["CONFIRM_REFRESH"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("ENABLED");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"confirm_refresh\" value=\"0\"";
        // line 37
        if ( !(isset($context["CONFIRM_REFRESH"]) ? $context["CONFIRM_REFRESH"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("DISABLED");
        echo "</label></dd>
</dl>
</fieldset>

<fieldset>
<legend>";
        // line 42
        echo $this->env->getExtension('phpbb')->lang("AVAILABLE_CAPTCHAS");
        echo "</legend>
<dl>
\t<dt><label for=\"captcha_select\">";
        // line 44
        echo $this->env->getExtension('phpbb')->lang("CAPTCHA_SELECT");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("CAPTCHA_SELECT_EXPLAIN");
        echo "</span></dt>
\t<dd><select id=\"captcha_select\" name=\"select_captcha\" onchange=\"(document.getElementById('acp_captcha')).submit()\" >";
        // line 45
        echo (isset($context["CAPTCHA_SELECT"]) ? $context["CAPTCHA_SELECT"] : null);
        echo "</select></dd>
</dl>
 ";
        // line 47
        if ((isset($context["S_CAPTCHA_HAS_CONFIG"]) ? $context["S_CAPTCHA_HAS_CONFIG"] : null)) {
            // line 48
            echo "<dl>
\t<dt><label for=\"configure\">";
            // line 49
            echo $this->env->getExtension('phpbb')->lang("CAPTCHA_CONFIGURE");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb')->lang("CAPTCHA_CONFIGURE_EXPLAIN");
            echo "</span></dt>
\t<dd><input class=\"button2\" type=\"submit\" id=\"configure\" name=\"configure\" value=\"";
            // line 50
            echo $this->env->getExtension('phpbb')->lang("CONFIGURE");
            echo "\" /></dd>
</dl>
";
        }
        // line 53
        echo "</fieldset>

";
        // line 55
        if ((isset($context["CAPTCHA_PREVIEW_TPL"]) ? $context["CAPTCHA_PREVIEW_TPL"] : null)) {
            // line 56
            echo "<fieldset>
\t<legend>";
            // line 57
            echo $this->env->getExtension('phpbb')->lang("PREVIEW");
            echo "</legend>
";
            // line 58
            $location = (("" . (isset($context["CAPTCHA_PREVIEW_TPL"]) ? $context["CAPTCHA_PREVIEW_TPL"] : null)) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate((("" . (isset($context["CAPTCHA_PREVIEW_TPL"]) ? $context["CAPTCHA_PREVIEW_TPL"] : null)) . ""), "acp_captcha.html", 58)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 59
            echo "</fieldset>
";
        }
        // line 61
        echo "
<fieldset>
\t<legend>";
        // line 63
        echo $this->env->getExtension('phpbb')->lang("ACP_SUBMIT_CHANGES");
        echo "</legend>
\t<p class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"main_submit\" name=\"main_submit\" value=\"";
        // line 65
        echo $this->env->getExtension('phpbb')->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"form_reset\" name=\"reset\" value=\"";
        // line 66
        echo $this->env->getExtension('phpbb')->lang("RESET");
        echo "\" />&nbsp;
\t</p>
\t";
        // line 68
        echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
        echo "
</fieldset>
</form>

";
        // line 72
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_captcha.html", 72)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_captcha.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  255 => 72,  248 => 68,  243 => 66,  239 => 65,  234 => 63,  230 => 61,  226 => 59,  214 => 58,  210 => 57,  207 => 56,  205 => 55,  201 => 53,  195 => 50,  188 => 49,  185 => 48,  183 => 47,  178 => 45,  171 => 44,  166 => 42,  154 => 37,  146 => 36,  139 => 35,  129 => 32,  121 => 31,  114 => 30,  108 => 27,  101 => 26,  95 => 23,  88 => 22,  78 => 19,  70 => 18,  63 => 17,  57 => 14,  51 => 11,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }
}
