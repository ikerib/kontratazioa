import './styles/vue.scss'

import Vue from 'vue';
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

new Vue({
    components: { App },
    template: "<App/>",
    router: rutas
}).$mount("#app");

