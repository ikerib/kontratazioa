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
            <td class="col-sm-4">{{notify.noiz | luxon('yyyy-MM-dd HH:mm:ss')}}</td>
            <td class="col-sm-4"><button class="btn btn-xs btn-danger">Ezabatu</button></td>
          </tr>
        </tbody>
      </table>

</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  name: "NotificationList",
  computed: mapGetters({
    notifications: 'allNotifications'
  }),
  methods:{
    ...mapActions(["fetchNotifications"]),
  },
}
</script>

<style scoped>

</style>
