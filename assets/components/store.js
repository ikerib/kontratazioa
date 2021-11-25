import Vue from "vue"
import Vuex from "vuex"
import axios from "axios";
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
        },
    },
    getters: {
        allNotifications: (state) => {
            console.log("INI getter allNotifications")
            return state.notitications;
            console.log("FIN getter allNotifications")
        }
    },
    actions: {
        async fetchNotifications({ commit }) {
            commit('SET_IS_LOADING', true);
            console.log("state")
            console.log(this.state.selectedRow);
            console.log("state")
            if (this.state.selectedRow !== '') {
                const url = routing.generate('api_lotes_notifications_get_subresource', { id: this.state.selectedRow })+".json";
                console.log(url);
                await axios.get(url)
                    .then(res => {
                        console.log(res);
                        const notifications = res.data;
                        commit('SET_NOTIFICATIONS', notifications);
                        commit('SET_IS_LOADING', false);
                    }).catch(err => {
                        console.log('error', err);
                        commit('SET_IS_LOADING', false);
                    });
            }
        },
    }

})
