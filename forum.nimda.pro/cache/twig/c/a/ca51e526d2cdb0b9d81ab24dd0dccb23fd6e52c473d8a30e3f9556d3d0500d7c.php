<?php

/* captcha_recaptcha.html */
class __TwigTemplate_ca51e526d2cdb0b9d81ab24dd0dccb23fd6e52c473d8a30e3f9556d3d0500d7c extends Twig_Template
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
        if ((isset($context["S_RECAPTCHA_AVAILABLE"]) ? $context["S_RECAPTCHA_AVAILABLE"] : null)) {
            // line 2
            echo "\t<dl>
\t<dd>
\t\t<script type=\"text/javascript\">
\t\t// <![CDATA[
\t\tvar RecaptchaOptions = {
\t\t\tlang : '";
            // line 7
            echo addslashes($this->env->getExtension('phpbb')->lang("RECAPTCHA_LANG"));
            echo "',
\t\t\ttheme : 'clean'
\t\t};
\t\t// ]]>
\t\t</script>
\t\t<script type=\"text/javascript\" src=\"";
            // line 12
            echo (isset($context["RECAPTCHA_SERVER"]) ? $context["RECAPTCHA_SERVER"] : null);
            echo "/challenge?k=";
            echo (isset($context["RECAPTCHA_PUBKEY"]) ? $context["RECAPTCHA_PUBKEY"] : null);
            echo (isset($context["RECAPTCHA_ERRORGET"]) ? $context["RECAPTCHA_ERRORGET"] : null);
            echo "\"></script>
\t\t<script type=\"text/javascript\">
\t\t// <![CDATA[
\t\t";
            // line 15
            if (((isset($context["S_CONTENT_DIRECTION"]) ? $context["S_CONTENT_DIRECTION"] : null) == "rtl")) {
                // line 16
                echo "\t\t\tdocument.getElementById('recaptcha_table').style.direction = 'ltr';
\t\t";
            }
            // line 18
            echo "\t\t// ]]>
\t\t</script>


\t<noscript>
\t<div>
\t\t<object data=\"";
            // line 24
            echo (isset($context["RECAPTCHA_SERVER"]) ? $context["RECAPTCHA_SERVER"] : null);
            echo "/noscript?k=";
            echo (isset($context["RECAPTCHA_PUBKEY"]) ? $context["RECAPTCHA_PUBKEY"] : null);
            echo (isset($context["RECAPTCHA_ERRORGET"]) ? $context["RECAPTCHA_ERRORGET"] : null);
            echo "\" type=\"text/html\" height=\"300\" width=\"500\"></object><br />
\t\t<textarea name=\"recaptcha_challenge_field\" rows=\"3\" cols=\"40\"></textarea>
\t\t<input type=\"hidden\" name=\"recaptcha_response_field\" value=\"manual_challenge\" />
\t</div>
\t</noscript>

\t</dd>
\t</dl>
";
        } else {
            // line 33
            echo $this->env->getExtension('phpbb')->lang("RECAPTCHA_NOT_AVAILABLE");
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "captcha_recaptcha.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 33,  59 => 24,  51 => 18,  47 => 16,  45 => 15,  36 => 12,  28 => 7,  21 => 2,  19 => 1,);
    }
}
