<?php

namespace App\Infrastructure\Menu;

use App\Infrastructure\Menu\Entity\MenuItem;

/**
 * Class Menu.
 */
class Menu
{
    private string $menu_items  = '';
    private bool $parent_active = false;
    private ?int $sub_level     = null;

    /** @var array<int, bool|string> */
    private array $activeMenus = [];

    /**
     * @param string $alias
     *
     * @return string
     */
    public function getMenu(
        string $alias = 'sidebar_menu'
    ): string {
        $currentUrl = '/' . ltrim(request()->path(), '/');
        /** @var array<int, MenuItem> $menus */
        $menus = config('sidebar.menu');
        foreach ($menus as $menu) {
            /** @var \App\Infrastructure\Menu\Entity\MenuItem $menu */
            $subMenu = '';

            $subMenuItems = $menu->getSubMenu();
            $hasSubMenu   = ! empty($subMenuItems);

            if ($hasSubMenu) {
                $this->sub_level = 0;
                $subMenu .= '<ul class="sub-menu">';

                if ($alias === 'top_menu') {
                    $subMenu .= $this->renderHeaderSubMenu(
                        $subMenuItems,
                        $currentUrl
                    );
                } else {
                    $subMenu .= $this->renderSubMenu(
                        $subMenuItems,
                        $currentUrl
                    );
                }
                $subMenu .= '</ul>';
            }

            $path = $this->getUrl($menu);

            $active = ($currentUrl === $path || $this->parent_active)
                ? 'active' : '';

            $this->menu_items .= "<li class=\"{$menu->hasSub()} {$active}\">
                        <a href=\"{$path}\">
                            {$menu->hasImg()}
                            {$menu->hasIcon()}
                            {$menu->hasTitle()}
                            {$menu->hasBadge()}
                            {$menu->hasCaret()}
                        </a>
                        {$subMenu}
                    </li>
                ";
        }

        return $this->menu_items;
    }

    /**
     * @param \App\Infrastructure\Menu\Entity\MenuItem[] $value
     * @param string                                     $currentUrl
     *
     * @return string
     */
    private function renderHeaderSubMenu(
        array $value,
        string $currentUrl
    ): string {
        $subMenu = [];
        $this->sub_level++;
        $this->activeMenus[$this->sub_level] = '';

        foreach ($value as $menu) {
            $subSubMenu = '';

            if (! empty($menu->getSubMenu())) {
                $subSubMenu .= '<ul class="sub-menu">';
                $subSubMenu .= $this->renderHeaderSubMenu(
                    $menu->getSubMenu(),
                    $currentUrl
                );
                $subSubMenu .= '</ul>';
            }

            $path = $this->getUrl($menu);

            $active = $this->getActive($path, $currentUrl, $this->sub_level);

            $subMenu[] = "<li class=\"{$menu->hasSub()} {$active}\">
                            <a href=\"{$path}\">
                            {$menu->hasTitle()}
                            {$menu->hasHighlight()}
                            {$menu->hasCaretSubMenu()}</a>
                            {$subSubMenu}
                        </li>";
        }

        return implode('', $subMenu);
    }

    /**
     * @param \App\Infrastructure\Menu\Entity\MenuItem[] $value
     * @param string                                     $currentUrl
     *
     * @return string
     */
    private function renderSubMenu(array $value, string $currentUrl): string
    {
        $subMenu = [];
        $this->sub_level++;
        $this->activeMenus[$this->sub_level] = '';

        foreach ($value as $menu) {
            $subSubMenu = '';

            if (! empty($menu->getSubMenu())) {
                $subSubMenu .= '<ul class="sub-menu">';
                $subSubMenu .= self::renderSubMenu(
                    $menu->getSubMenu(),
                    $currentUrl
                );
                $subSubMenu .= '</ul>';
            }

            $path = $this->getUrl($menu);

            $active = $this->getActive($path, $currentUrl, $this->sub_level);

            $subMenu[] = "<li class=\"{$menu->hasSub()} {$active}\">
                                <a href=\"{$path}\">
                                {$menu->hasCaretSubMenu()}
                                {$menu->hasTitle()}
                                {$menu->hasHighlight()}
                                </a>
                                {$subSubMenu}
                            </li>";
        }

        return implode('', $subMenu);
    }

    /**
     * @param string   $path
     * @param string   $currentUrl
     * @param null|int $currentLevel
     *
     * @return string
     */
    private function getActive(
        string $path,
        string $currentUrl,
        ?int $currentLevel
    ): string {
        $active = ($currentUrl === $path) ? 'active' : '';

        if ($active) {
            $this->parent_active                     = true;
            $this->activeMenus[$this->sub_level - 1] = true;
        }

        if (! empty($this->activeMenus[$currentLevel])) {
            $active = 'active';
        }

        return $active;
    }

    /**
     * @param \App\Infrastructure\Menu\Entity\MenuItem $menu
     *
     * @return string
     */
    private function getUrl(MenuItem $menu): string
    {
        if ($menu->getUrl() === '') {
            return 'javascript:;';
        }

        return '/' . config('app.backend') . $menu->getUrl();
    }
}
