import './styles/vue.scss'

import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import axios from 'axios';
import VueAxios from "vue-axios";
Vue.use(VueAxios, axios);


import App from './components/App'
import VueLuxon from "vue-luxon";
Vue.use(VueLuxon, {
    input: {
        zone: "utc",
        format: "iso"
    }
});

import vueRouter from 'vue-router'
import router from "./components/router";
Vue.use(vueRouter);

const rutas = new vueRouter({
    routes: router,
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});

import store from './components/store'

new Vue({
    components: { App },
    template: "<App/>",
    router: rutas,
    store: store
}).$mount("#app");

