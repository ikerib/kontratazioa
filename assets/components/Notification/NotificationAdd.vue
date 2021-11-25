<template>
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="submit-form">
<!--        <form @submit.prevent="saveNotification(notification)">-->
          <div class="form-group">
            <label>Noiz</label>
            <date-picker v-model="date" :config="options"></date-picker>
          </div>
          <a v-on:click.stop="saveNotification" class="btn btn-success">Gorde</a>
<!--        </form>-->
      </div>
    </div>
    <div class="col-2"></div>
  </div>
</template>

<script>
// import 'bootstrap/dist/css/bootstrap.css';

// Import this component
import datePicker from 'vue-bootstrap-datetimepicker';

// Import date picker css
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
import {mapActions} from "vuex";

export default {
  name: "add-notifiation",
  data() {
    return {
      date: null,
      options: {
        // https://momentjs.com/docs/#/displaying/
        format: 'DD/MM/YYYY HH:mm:ss',
        sideBySide:true,
        // inline:true,
        useCurrent: false,
        showClear: true,
        showClose: true,
        showTodayButton: true,
        locale: 'eu'
      },
      user: null,
      aaa: null,
      noiz: null
    };
  },
  methods: {
    saveNotification() {
      let data = {
        noiz: this.date,
        user: "/api/users/" + this.user,
        lote: "/api/lotes/" + this.$store.state.selectedRow
      };
      console.log(data);
      this.addNotification(data);
    },

    ...mapActions(['addNotification'])
  },
  mounted() {
    if (window.user) {
      this.user = window.user;
    }
  }
};
</script>

<style>
.submit-form {
  /*max-width: 600px;*/
  margin: auto;
}

.bootstrap-datetimepicker-widget.wider {
  width: 100% !important;
}

</style>
