<template>
  <div class="col-12" v-show="selectedRow">
    <input id="txtRow" type="hidden" v-model="selectedRow">
    <div class="card card-secondary">
      <div class="card-header">
        <h5 class="card-title m-0">Jakinazpenak: </h5>
        <div class="card-tools">
          <router-link tag="button" class="btn btn-default" :to="{
            name: 'NotificationAdd',
            params: {selectedRow}
          }"><i class="fas fa-plus-circle"></i> Berria</router-link>
          <router-link tag="button" class="btn btn-default" :to="{
            name: 'NotificationList',
            params: {selectedRow:selectedRow}
          }"><i class="fas fa-list"></i> Zerrenda</router-link>
        </div>
      </div>
    </div>
    <div class="card-body">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  name: "app",
  data: function() {
    return {
      selectedRow:'',
      isNew: false,
    }
  },
};
</script>
