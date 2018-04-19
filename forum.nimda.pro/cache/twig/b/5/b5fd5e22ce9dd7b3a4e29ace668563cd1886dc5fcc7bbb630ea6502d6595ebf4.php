<?php

/* @stoker_ads/event/viewtopic_body_postrow_post_after.html */
class __TwigTemplate_b5fd5e22ce9dd7b3a4e29ace668563cd1886dc5fcc7bbb630ea6502d6595ebf4 extends Twig_Template
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
            if ($this->getAttribute((isset($context["postrow"]) ? $context["postrow"] : null), "S_FIRST_ROW", array())) {
                // line 3
                echo "<div class=\"panel online\" style=\"padding-top:0;padding-bottom:0;background-color:#ECF3F7;\">
\t<div style=\"overflow:hidden; height:100px; position:relative;\"><img src=\"";
                // line 4
                echo (isset($context["ROOT_PATH"]) ? $context["ROOT_PATH"] : null);
                echo "images/warnad.png\" alt=\"Disable adblock\" width=\"100\" height=\"100\" style=\"float:left; margin-right:10px;\" class=\"responsive-hide\" /><p style=\"font-size:1.5em;padding-top:12px;padding-left:10px;\">This site is supported by ads and donations.<br />If you see this text you are blocking our ads.<br />Please disable AdBlock.</p>
\t\t<div style=\"position:absolute; top:0; left:0;\">
\t\t<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
\t\t<!-- forum2 -->
\t\t<ins class=\"adsbygoogle\"
\t\tstyle=\"display:inline-block;width:728px;height:90px\"
\t\tdata-ad-client=\"ca-pub-5538463974358536\"
\t\tdata-ad-slot=\"6714888817\"></ins>
\t\t<script>
\t\t(adsbygoogle = window.adsbygoogle || []).push({});
\t\t</script>
\t\t</div>
\t</div>
</div>
<hr class=\"divider\" />
";
            }
            // line 20
            if ((($this->getAttribute((isset($context["postrow"]) ? $context["postrow"] : null), "S_ROW_COUNT", array()) > 1) && $this->getAttribute((isset($context["postrow"]) ? $context["postrow"] : null), "S_LAST_ROW", array()))) {
                // line 21
                echo "<div class=\"panel online\" style=\"padding-top:0;padding-bottom:0;background-color:#ECF3F7;\">
\t<div style=\"overflow:hidden; height:100px; position:relative;\"><img src=\"";
                // line 22
                echo (isset($context["ROOT_PATH"]) ? $context["ROOT_PATH"] : null);
                echo "images/warnad.png\" alt=\"Disable adblock\" width=\"100\" height=\"100\" style=\"float:left; margin-right:10px;\" class=\"responsive-hide\" /><p style=\"font-size:1.5em;padding-top:12px;padding-left:10px;\">This site is supported by ads and donations.<br />If you see this text you are blocking our ads.<br />Please disable AdBlock.</p>
\t\t<div style=\"position:absolute; top:0; left:0;\">
\t\t<!-- forum2 -->
\t\t<ins class=\"adsbygoogle\"
\t\tstyle=\"display:inline-block;width:728px;height:90px\"
\t\tdata-ad-client=\"ca-pub-5538463974358536\"
\t\tdata-ad-slot=\"6714888817\"></ins>
\t\t<script>
\t\t(adsbygoogle = window.adsbygoogle || []).push({});
\t\t</script>
\t\t</div>
\t</div>
</div>
<hr class=\"divider\" />
";
            }
            // line 37
            if ((($this->getAttribute((isset($context["postrow"]) ? $context["postrow"] : null), "S_ROW_COUNT", array()) == 3) &&  !$this->getAttribute((isset($context["postrow"]) ? $context["postrow"] : null), "S_LAST_ROW", array()))) {
                // line 38
                echo "<div class=\"panel online\" style=\"padding-top:0;padding-bottom:0;background-color:#ECF3F7;\">
\t<div style=\"overflow:hidden; height:100px; position:relative;\"><img src=\"";
                // line 39
                echo (isset($context["ROOT_PATH"]) ? $context["ROOT_PATH"] : null);
                echo "images/warnad.png\" alt=\"Disable adblock\" width=\"100\" height=\"100\" style=\"float:left; margin-right:10px;\" class=\"responsive-hide\" /><p style=\"font-size:1.5em;padding-top:12px;padding-left:10px;\">This site is supported by ads and donations.<br />If you see this text you are blocking our ads.<br />Please disable AdBlock.</p>
\t\t<div style=\"position:absolute; top:0; left:0;\">
\t\t<!-- forum2 -->
\t\t<ins class=\"adsbygoogle\"
\t\tstyle=\"display:inline-block;width:728px;height:90px\"
\t\tdata-ad-client=\"ca-pub-5538463974358536\"
\t\tdata-ad-slot=\"6714888817\"></ins>
\t\t<script>
\t\t(adsbygoogle = window.adsbygoogle || []).push({});
\t\t</script>
\t\t</div>
\t</div>
</div>
<hr class=\"divider\" />
";
            }
        }
    }

    public function getTemplateName()
    {
        return "@stoker_ads/event/viewtopic_body_postrow_post_after.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 39,  70 => 38,  68 => 37,  50 => 22,  47 => 21,  45 => 20,  26 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }
}
