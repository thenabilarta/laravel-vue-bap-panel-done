<template>
  <div>
    <div class="header">
      <h1>Display</h1>
    </div>
    <div class="body">
      <!-- <Modal v-if="modal" v-on:update="onUpdate"></Modal> -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col" @click="orderById">ID</th>
            <th scope="col" @click="orderByDisplayName">Display</th>
            <th scope="col">Authorized</th>
            <th scope="col">Logged In</th>
            <th scope="col">Default Layout</th>
            <th scope="col">Last Accessed</th>
            <th scope="col">IP Address</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <TableRow
            v-for="display in displays"
            v-bind:key="display.id"
            v-bind:display="display"
          ></TableRow>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import _ from "lodash";

import TableRow from "./components/TableRow";
// import Modal from "./components/Modal";

export default {
  components: {
    TableRow: TableRow,
    // Modal: Modal,
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/display/data")
      // .then((res) => console.log(res));
      .then((res) => (this.displays = res.data));
  },
  data() {
    return {
      displays: {},
      modal: false,
    };
  },
  watch: {
    displays: function() {
      console.log(this.displays);
    },
  },
  methods: {
    orderById() {
      let sortedDisplay = _.sortBy(this.displays, (o) => o.display_id);
      this.displays = sortedDisplay;
    },
    orderByDisplayName() {
      let sortedDisplayByName = _.sortBy(
        this.displays,
        ["display_name"],
        "asc"
      );
      this.displays = sortedDisplayByName;
    },
    // toggleModal() {
    //   this.modal = !this.modal;
    // },
    // onUpdate() {
    //   this.modal = false;
    //   axios
    //     .get("http://127.0.0.1:8000/panel/main")
    //     .then((res) => (this.medias = res.data));
    // },
    // onDelete() {
    //   axios
    //     .get("http://127.0.0.1:8000/panel/main")
    //     .then((res) => (this.medias = res.data));
    // },
  },
};
</script>

<style scoped>
.body {
  position: relative;
}

th {
  cursor: pointer;
}
</style>
