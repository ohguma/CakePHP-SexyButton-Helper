===========================
CakePHP SexyButton Helper
ohguma
===========================

Sexy Buttons is a HTML/CSS-based framework for creating beautiful web site buttons.
  http://code.google.com/p/sexybuttons/

Sexy Buttons Quick Start Guide and Demo
  http://sexybuttons.googlecode.com/svn/trunk/index.html


----

[*_controller.php]
var $helpers = array('SexyButton');

[layouts/default.ctp]
echo $html->css('sexybuttons');

[views/*/*.ctp]
echo $sexyButton->link('link text', $attributes);
echo $sexyButton->button('button text', $attributes);

----

Use predefined icons:
    $attributes['icon'] = 'ok';
    

Button Dispabled :
    $attributes['disabled'] = true;

----
