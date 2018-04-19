<?php

/* ucp_avatar_options_local.html */
class __TwigTemplate_a62532e7d9fdfaeaad0c7b1bb9ef6b79fd7fa78b01bb875fd84ab4c662cc2da6 extends Twig_Template
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
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "avatar_local_cats", array()))) {
            // line 2
            echo "<label for=\"category\">";
            echo $this->env->getExtension('phpbb')->lang("AVATAR_CATEGORY");
            echo $this->env->getExtension('phpbb')->lang("COLON");
            echo " <select name=\"avatar_local_cat\" id=\"category\">
";
            // line 3
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "avatar_local_cats", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["avatar_local_cats"]) {
                // line 4
                echo "<option value=\"";
                echo $this->getAttribute($context["avatar_local_cats"], "NAME", array());
                echo "\"";
                if ($this->getAttribute($context["avatar_local_cats"], "SELECTED", array())) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo $this->getAttribute($context["avatar_local_cats"], "NAME", array());
                echo "</option>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['avatar_local_cats'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 6
            echo "</select></label>
<input type=\"submit\" value=\"";
            // line 7
            echo $this->env->getExtension('phpbb')->lang("GO");
            echo "\" name=\"avatar_local_go\" class=\"button2\" />

<div id=\"gallery\">
";
            // line 10
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "avatar_local_row", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["avatar_local_row"]) {
                // line 11
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["avatar_local_row"], "avatar_local_col", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["avatar_local_col"]) {
                    // line 12
                    echo "\t<label for=\"av-";
                    echo $this->getAttribute($context["avatar_local_row"], "S_ROW_COUNT", array());
                    echo "-";
                    echo $this->getAttribute($context["avatar_local_col"], "S_ROW_COUNT", array());
                    echo "\"><img src=\"";
                    echo $this->getAttribute($context["avatar_local_col"], "AVATAR_IMAGE", array());
                    echo "\" alt=\"\" /><br />
\t<input type=\"radio\" name=\"avatar_local_file\" id=\"av-";
                    // line 13
                    echo $this->getAttribute($context["avatar_local_row"], "S_ROW_COUNT", array());
                    echo "-";
                    echo $this->getAttribute($context["avatar_local_col"], "S_ROW_COUNT", array());
                    echo "\" value=\"";
                    echo $this->getAttribute($context["avatar_local_col"], "AVATAR_FILE", array());
                    echo "\" /></label>
";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['avatar_local_col'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['avatar_local_row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "</div>
";
        } else {
            // line 18
            echo "<p><strong>";
            echo $this->env->getExtension('phpbb')->lang("NO_AVATARS");
            echo "</strong></p>
";
        }
    }

    public function getTemplateName()
    {
        return "ucp_avatar_options_local.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 18,  88 => 16,  72 => 13,  63 => 12,  59 => 11,  55 => 10,  49 => 7,  46 => 6,  31 => 4,  27 => 3,  21 => 2,  19 => 1,);
    }
}
