<?php

namespace App\View\Components\blocks\Footer;

use Illuminate\View\Component;

class Footer3 extends Component
{

    public $logo;
    public $socials;
    public $copyright;
    public $address;
    public $phone;
    public $email;
    public $menu;

    public function __construct($logo = null, $socials = null, $copyright = null,
        $address = null, $phone = null, $email = null
    ) {
        $this->logo = $logo;
        $this->socials = $socials;
        $this->copyright = $copyright;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->menu = $this->getMenu();
    }

    public function render()
    {
        return view('components.blocks.footer.footer3');
    }

    private function getMenu()
    {
        $footerMenu = get_field('settings_footer_menu', 'option');

        if (!$footerMenu) {
            return false;
        }

        return $footerMenu;
    }
}
