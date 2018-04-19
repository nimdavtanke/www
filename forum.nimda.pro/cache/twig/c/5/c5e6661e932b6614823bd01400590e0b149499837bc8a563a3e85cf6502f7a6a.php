<?php

/* @stoker_ads/event/overall_header_page_body_before.html */
class __TwigTemplate_c5e6661e932b6614823bd01400590e0b149499837bc8a563a3e85cf6502f7a6a extends Twig_Template
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
        if ( !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)) {
            // line 2
            echo "\t<div class=\"navbar\" style=\"background-color:#cadceb;text-align:center;margin-top:4px;overflow:hidden;\">
\t<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
\t<!-- forum2 -->
\t<ins class=\"adsbygoogle\"
\tstyle=\"display:inline-block;width:728px;height:90px\"
\tdata-ad-client=\"ca-pub-5538463974358536\"
\tdata-ad-slot=\"6714888817\"></ins>
\t<script>
\t(adsbygoogle = window.adsbygoogle || []).push({});
\t</script>
\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@stoker_ads/event/overall_header_page_body_before.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  19 => 1,);
    }
}
