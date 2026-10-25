<?php

namespace App\View\Components\blocks\Footer;

use Illuminate\View\Component;

class Footer7 extends Component
{
    public $logo;
    public $copyright;
    public $menu;

    public function __construct($logo = null, $copyright = null)
    {
        $this->copyright = $copyright;
        $this->logo = $logo;
        $this->menu = $this->getMenu();
    }

    public function render()
    {
        return view('components.blocks.footer.footer7');
    }

    private function getMenu()
    {
        $footerMenu = get_field('settings_footer_simple_menu', 'option');

        if (!$footerMenu || !is_array($footerMenu)) {
            return false;
        }

        $footerMenu = array_map(function ($item) {
            return [
                'title' => $item['link']['title'],
                'url' => $item['link']['url'],
                'target' => $item['link']['target'],
            ];
        }, $footerMenu);

        return $footerMenu;
    }
}
