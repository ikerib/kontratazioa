<template>
      <table class="table table-bordered">
        <thead>
        <tr class="d-flex">
          <th class="col-sm-4">#</th>
          <th class="col-sm-4">Noiz</th>
          <th class="col-sm-4"></th>
        </tr>
        </thead>
        <tbody>
          <tr class="d-flex" v-for="(notify,i) in notifications" :key="i">
            <td class="col-sm-4">{{notify.id}}</td>
            <td class="col-sm-4">{{notify.noiz | luxon("relative")}}</td>
            <td class="col-sm-4"></td>
          </tr>
        </tbody>
      </table>

</template>

<script>
import axios from "axios";
import {mapActions, mapGetters} from "vuex";

export default {
  name: "NotificationList",
  computed: mapGetters({
    notifications: 'allNotifications'
  }),
  methods:{
    ...mapActions(["fetchNotifications"]),
  },

  // methods: {
  //   btnAddNotificationHandler() {
  //     console.log("kk");
  //   },
  //   rowSelectHandler(id){
  //     const url = routing.generate('api_lotes_notifications_get_subresource', { id: id });
  //     console.log(url);
  //     axios.get(url+".json").then((result) => {
  //       this.notifications = result.data;
  //
  //       console.log(result.data);
  //     })
  //   }
  // },
  // mounted() {
  //   this.rowSelectHandler(this.selectedRow);
  // },
  // watch: {
  //   selectedRow: function(newVal, oldVal) {
  //     this.rowSelectHandler(newVal);
  //   }
  // }
}
</script>

<style scoped>

</style>
