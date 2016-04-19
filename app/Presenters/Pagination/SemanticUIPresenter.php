<?php
namespace Omega\Presenters\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;

class SemanticUIPresenter extends BootstrapThreePresenter
{
    /**
     * Convert the URL window into Zurb Foundation HTML.
     *
     * @return string
     */
    public function links()
    {
        if (!$this->hasPages())
            return '';

        return sprintf(
            '<div class="ui right floated pagination menu">%s %s %s</div>',
            $this->getPreviousButton(),
            $this->getLinks(),
            $this->getNextButton()
        );
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<a class="active item">' . $text . '</a>';
    }

    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        return '<a class="item" href="' . htmlentities($url) . '">' . $page . '</a>';
    }

    /**
     * Get a pagination "dot" element.
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper('&hellip;');
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<a class="ui disabled item">' . $text . '</a>';
    }
}
