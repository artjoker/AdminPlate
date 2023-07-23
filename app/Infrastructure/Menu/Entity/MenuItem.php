<?php

namespace App\Infrastructure\Menu\Entity;

class MenuItem
{
    /**
     * @param null|string $icon
     * @param null|string $title
     * @param null|string $label
     * @param null|string $img
     * @param null|string $badge
     * @param string      $url
     * @param bool        $caret
     * @param bool        $highlight
     * @param MenuItem[]  $sub_menu
     */
    public function __construct(
        private readonly ?string $icon = null,
        private readonly ?string $title = null,
        private readonly ?string $label = null,
        private readonly ?string $img = null,
        private readonly ?string $badge = null,
        private readonly string $url = '',
        private readonly bool $caret = false,
        private readonly bool $highlight = false,
        private array $sub_menu = [],
    ) {
    }

    /**
     * @return bool
     */
    public function isHighlight(): bool
    {
        return $this->highlight;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return null|string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return null|string
     */
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * @return null|string
     */
    public function getBadge(): ?string
    {
        return $this->badge;
    }

    /**
     * @return null|string
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function isCaret(): bool
    {
        return $this->caret;
    }

    /**
     * @return MenuItem[]
     */
    public function getSubMenu(): array
    {
        return $this->sub_menu;
    }

    /**
     * @param \App\Infrastructure\Menu\Entity\MenuItem $item
     *
     * @return $this
     */
    public function pushSubMenu(MenuItem $item): static
    {
        $this->sub_menu[] = $item;

        return $this;
    }

    /**
     * @return string
     */
    public function hasSub(): string
    {
        return (! empty($this->sub_menu)) ? 'has-sub' : '';
    }

    /**
     * @return string
     */
    public function hasCaret(): string
    {
        return ($this->caret) ? '<b class="caret"></b>' : '';
    }

    /**
     * @return string
     */
    public function hasCaretSubMenu(): string
    {
        return (! empty($this->sub_menu)) ? '<b class="caret pull-right"></b>' : '';
    }

    /**
     * @return string
     */
    public function hasIcon(): string
    {
        return ($this->icon) ? "<i class=\"{$this->icon}\"></i>" : '';
    }

    /**
     * @return string
     */
    public function hasImg(): string
    {
        return ($this->img)
            ? "<div class=\"icon-img\"><img src=\"{$this->img}\" /></div>" : '';
    }

    /**
     * @return string
     */
    public function hasLabel(): string
    {
        return ($this->label)
            ? "<span class=\"label label-theme m-l-5\">{$this->label}</span>"
            : '';
    }

    /**
     * @return string
     */
    public function hasTitle(): string
    {
        return ($this->title)
            ? '<span>' . __('backend.' . $this->title) . $this->hasLabel()
              . '</span>' : '';
    }

    /**
     * @return string
     */
    public function hasHighlight(): string
    {
        return ($this->highlight)
            ? '<i class="fa fa-paper-plane text-theme m-l-5"></i>' : '';
    }

    /**
     * @return string
     */
    public function hasBadge(): string
    {
        return ($this->badge)
            ? "<span class=\"badge pull-right\">{$this->badge}</span>" : '';
    }

    /**
     * @param string $currentUrl
     *
     * @return string
     */
    public function activeUrl(string $currentUrl): string
    {
        return ($currentUrl === $this->url) ? 'active' : '';
    }
}
