<template>
  <div class="col-12" v-show="selectedRow">
    <input id="txtRow" type="hidden" v-model="selectedRow">
    <div class="card card-secondary">
      <div class="card-header">
        <h5 class="card-title m-0">Jakinazpenak: </h5>
        <div class="card-tools">
          <button v-on:click.stop.prevent="btnAddNotificationHandler" class="btn btn-default "><i class="fas fa-bell"></i> Berria</button>
        </div>
      </div>

    </div>
    <div class="card-body">
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
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Notification",
  data: function() {
    return {
      selectedRow:'',
      notifications: []
    }
  },
  methods: {
    btnAddNotificationHandler() {
      console.log("kk");
    },
    rowSelectHandler(id){
      const url = routing.generate('api_lotes_notifications_get_subresource', { id: id });
      console.log(url);
      axios.get(url+".json").then((result) => {
        this.notifications = result.data;

        console.log(result.data);
      })
    }
  },
  watch: {
    selectedRow: function(newVal, oldVal) {
      this.rowSelectHandler(newVal);
    }
  }
}
</script>

<style scoped>

</style>
