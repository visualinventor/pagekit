<?php $view->script('themes', 'system/package:app/bundle/themes.js', ['vue', 'uikit-upload']) ?>

<div id="themes">

    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>

            <h2 class="uk-margin-remove">{{ 'Themes' | trans }}</h2>

            <div class="pk-search">
                <div class="uk-search">
                    <input class="uk-search-field" type="text" v-model="search">
                </div>
            </div>

        </div>
        <div data-uk-margin>

            <a class="uk-button uk-button-primary">{{ 'Upload' | trans }}</a>

        </div>
    </div>

    <div class="uk-grid uk-grid-match uk-grid-width-medium-1-2 uk-grid-width-xlarge-1-3" data-uk-grid-margin>
        <div v-repeat="pkg: packages | filterBy search in 'title'">
            <div class="uk-panel uk-panel-box uk-visible-hover">

                <div class="uk-panel-teaser uk-position-relative">

                    <div class="uk-overlay uk-overlay-hover uk-display-block">
                        <div class="uk-cover-background uk-position-cover" style="background-image: url({{icon(pkg)}});"></div>
                        <canvas class="uk-responsive-width uk-display-block" width="800" height="600"></canvas>
                        <div class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div class="uk-flex uk-flex-middle">
                                <i class="pk-icon-search pk-icon-muted uk-margin-small-right"></i>
                                <h3 class="uk-margin-remove">Details</h3>
                                <a class="uk-position-cover" v-on="click: details(pkg)"></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
                    <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>

                        <h2 class="uk-panel-title uk-margin-remove">{{ pkg.title }}</h2>

                        <div class="uk-margin-left" v-show="!pkg.enabled">
                            <ul class="uk-subnav pk-subnav-icon uk-hidden">
                                <li><a class="pk-icon-star pk-icon-hover" title="{{ 'Enable' | trans }}" data-uk-tooltip="{delay: 500}" v-on="click: enable(pkg)"></a></li>
                                <li><a class="pk-icon-delete pk-icon-hover" title="{{ 'Delete' | trans }}" data-uk-tooltip="{delay: 500}" v-on="click: uninstall(pkg)" v-confirm="'Uninstall theme?'"></a></li>
                            </ul>
                        </div>

                    </div>
                    <div>

                        <button class="uk-button uk-button-primary uk-button-small" v-show="pkg.enabled">Customize</button>
                        <button class="uk-button uk-button-success uk-button-small">{{ 'Update' | trans }}</button>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <h3 class="uk-h1 uk-text-muted uk-text-center" v-show="packages | empty">{{ 'No theme found.' | trans }}</h3>

    <div class="uk-modal" v-el="details">
        <div class="uk-modal-dialog">
            <details api="{{ api }}" package="{{ package }}"></details>
        </div>
    </div>

</div>
