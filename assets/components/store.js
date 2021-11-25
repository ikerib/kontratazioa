import Vue from "vue"
import Vuex from "vuex"
import axios from "axios";
import { DateTime } from "luxon";
import moment from "moment";
Vue.use(Vuex)
export default new Vuex.Store({

    state:{
        isLoading: false,
        selectedRow: '',
        notitications: []
    },
    mutations: {
        SELECT_ROW: function(state, payload) {
            state.selectedRow = payload;
        },
        SET_IS_LOADING(state, isLoading) {
            state.isLoading = isLoading
        },
        SET_NOTIFICATIONS(state, payload) {
            state.notitications = payload;
        }
    },
    getters: {
        allNotifications: (state) => {
            return state.notitications;
        }
    },
    actions: {
        async fetchNotifications({ commit }) {
            commit('SET_IS_LOADING', true);
            if (this.state.selectedRow !== '') {
                const url = routing.generate('api_lotes_notifications_get_subresource', { id: this.state.selectedRow })+".json";
                await axios.get(url)
                    .then(res => {
                        const notifications = res.data;
                        commit('SET_NOTIFICATIONS', notifications);
                        commit('SET_IS_LOADING', false);
                    }).catch(err => {
                        commit('SET_IS_LOADING', false);
                    });
            }
        },
        async addNotification(context,data) {
            console.log(context);
            console.log('addNotification ini');
            // data.noiz = "2021-11-25 10:42:02.000";
            console.log(data);
            console.log('addNotification fin');

            const dat =DateTime.fromFormat(data.noiz,'DD/MM/YYYY HH:mm:ss');
            const da = moment(data.noiz, 'DD/MM/YYYY HH:mm:ss');
            console.log('dat')
            console.log(dat);
            console.log(da);

            console.log(dat.toFormat('YYYY-MM-DD HH:mm:ss'));
            data.noiz = da.format('YYYY-MM-DD HH:mm:ss');
            console.log('datadata')
            console.log(data)
            // console.log(dat.toISO());
            // data.noiz = dat.toFormat('DD/MM/YYYY H:mm:ss')
            const url = routing.generate('api_notifications_post_collection');
            console.log(url);
            console.log(data);
            await axios.post(url,data)
                .then (res => {
                    console.log('on')
                    context.dispatch('fetchNotifications');
                }).catch(err => {
                    console.log('error', err);
                });
        }
    }

})
