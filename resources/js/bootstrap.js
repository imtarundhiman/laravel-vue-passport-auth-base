import VueRouter from "vue-router";
window._ = require('lodash');

try {
    require('./includes.js')
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
let serverApiUrl = document.head.querySelector('meta[name="base-url"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    window.axios.defaults.baseURL = serverApiUrl.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Vue = require('vue');
import ReadMore from "vue-read-more";
import Notifications from 'vue-notification'
import VTooltip from 'v-tooltip'

Vue.use(ReadMore);
Vue.use(VueRouter);
Vue.use(Notifications);
Vue.use(VTooltip);

VTooltip.enabled = window.innerWidth > 768
VTooltip.options.defaultTemplate = '<div class="tooltip-vue" role="tooltip"><div class="tooltip-vue-arrow"></div><div class="tooltip-vue-inner"></div></div>';
VTooltip.options.defaultArrowSelector = '.tooltip-vue-arrow, .tooltip-vue__arrow';
VTooltip.options.defaultInnerSelector = '.tooltip-vue-inner, .tooltip-vue__inner';

require("es6-promise").polyfill();

window.moment = require("moment");