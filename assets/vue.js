import './styles/vue.scss'

import Vue from 'vue';
import Notification from './components/Notification'
import VueLuxon from "vue-luxon";
Vue.use(VueLuxon, {
    input: {
        zone: "utc",
        format: "iso"
    }
});

new Vue({
    components: { Notification },
    template: "<Notification/>"
}).$mount("#app");

