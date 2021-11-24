<template>
  <div class="submit-form">
    <div v-if="!submitted">
      <div class="form-group">
        <label for="title">Noiz</label>
        <input
            type="text"
            class="form-control"
            id="title"
            required
            v-model="notification.noiz"
            name="title"
        />
      </div>


      <button @click="saveNotification" class="btn btn-success">Submit</button>
    </div>

    <div v-else>
      <h4>You submitted successfully!</h4>
      <button class="btn btn-success" @click="newNotification">Add</button>
    </div>
  </div>
</template>

<script>

export default {
  name: "add-notifiation",
  props: ['selectedRow'],
  data() {
    return {
      notification: {
        id: null,
        noiz: ""
      },
      submitted: false
    };
  },
  methods: {
    saveNotification() {
      let data = {
        noiz: this.notification.noiz
      };


      // TutorialDataService.create(data)
      //     .then(response => {
      //       this.tutorial.id = response.data.id;
      //       console.log(response.data);
      //       this.submitted = true;
      //     })
      //     .catch(e => {
      //       console.log(e);
      //     });
    },

    newNotification() {
      this.submitted = false;
      this.notification = {};
    }
  }
};
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>
