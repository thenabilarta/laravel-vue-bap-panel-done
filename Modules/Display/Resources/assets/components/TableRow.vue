<template>
  <!-- <tr v-if="media"> -->
  <tr v-if="this.displayProp">
    <th scope="row">{{ displayProp.display_id }}</th>
    <td>{{ displayProp.display_name }}</td>
    <td>{{ displayProp.authorized == 1 ? "true" : "false" }}</td>
    <td>{{ displayProp.logged_in == 1 ? "true" : "false" }}</td>
    <td>{{ displayProp.default_layout }}</td>
    <td id="date">{{ new Date(displayProp.last_accessed * 1000) }}</td>
    <td>{{ displayProp.ip_address }}</td>
    <td>
      <button>Edit</button>
      <!-- <button @click="toEdit">Edit</button> -->
    </td>
    <td>
      <button>Delete</button>
      <!-- <button @click="toDelete">Delete</button> -->
    </td>
    <!-- <ModalEdit
      v-on:updateEdit="testBind"
      v-if="editing"
      v-bind:showdata="showdata"
    ></ModalEdit> -->
  </tr>
</template>

<script>
import axios from "axios";
import _ from "lodash";

// import ModalEdit from "./ModalEdit";

export default {
  name: "TableRow",
  props: ["display"],
  // components: {
  //   ModalEdit: ModalEdit,
  // },
  data() {
    return {
      displayProp: this.display,
      editing: false,
      showdata: {},
    };
  },
  methods: {
    // toDelete() {
    //   console.log(this.mediaProps.media_id);
    //   axios
    //     .get("http://127.0.0.1:8000/panel/delete/" + this.mediaProps.media_id)
    //     .then(() => this.testBind());
    // },
    // testBind() {
    //   this.$emit("update");
    //   this.editing = false;
    // },
    // toEdit() {
    //   this.editing = !this.editing;
    //   this.toShow();
    // },
    // toShow() {
    //   console.log(this.mediaProps.media_id);
    //   axios
    //     .get("http://127.0.0.1:8000/panel/edit/" + this.mediaProps.media_id)
    //     .then((res) => (this.showdata = res.data))
    //     .then(() => console.log(this.showdata));
    // },
  },
};
</script>

<style scoped>
#image-thumbnail {
  max-width: 50px;
}

td,
th {
  word-wrap: break-word;
  /* max-width: 100px; */
  text-overflow: ellipsis;
  overflow: hidden; /* make sure it hides the content that overflows */
  white-space: nowrap;
}

#date {
  max-width: 150px;
  text-overflow: ellipsis;
  overflow: hidden;
  word-wrap: break-word;
}
</style>
