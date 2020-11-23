<template>
  <div>
    <div class="header">
      <button @click="toggleModal">Add Media</button>
    </div>
    <div class="body">
      <Modal v-if="modal" v-on:update="onUpdate"></Modal>
      <table class="table">
        <thead>
          <tr>
            <th scope="col" @click="orderById">ID</th>
            <th scope="col" @click="orderByMediasName">Name</th>
            <th scope="col">Type</th>
            <th scope="col" @click="orderById">Thumbnail</th>
            <th scope="col">Duration</th>
            <th scope="col" @click="orderBySize">Size (bytes)</th>
            <th scope="col">Owner</th>
            <th scope="col">Permission</th>
            <th scope="col" @click="orderByMediaFileName">File Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <TableRow
            v-for="media in medias"
            v-bind:key="media.id"
            v-bind:media="media"
            v-on:update="onDelete"
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
import Modal from "./components/Modal";

export default {
  components: {
    TableRow: TableRow,
    Modal: Modal,
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/panel/main")
      // .then((res) => console.log(res));
      .then((res) => (this.medias = res.data));
  },
  data() {
    return {
      medias: {},
      modal: false,
      mediaNameASC: true,
      mediaIdASC: true,
      mediaSizeASC: true,
      mediaFileNameASC: true,
    };
  },
  watch: {
    medias: function() {
      console.log(this.medias);
    },
  },
  methods: {
    orderById() {
      if (this.mediaIdASC) {
        let sortedMediaByIdASC = _.orderBy(this.medias, ["media_id"], "asc");
        this.medias = sortedMediaByIdASC;
        this.mediaIdASC = false;
      } else {
        let sortedMediaByIdDESC = _.orderBy(this.medias, ["media_id"], "desc");
        this.medias = sortedMediaByIdDESC;
        this.mediaIdASC = true;
      }
    },
    orderBySize() {
      let parsedSize = _.forEach(this.medias, (val) => {
        let number = parseInt(val.size);
        val.size = number;
      });

      if (this.mediaSizeASC) {
        let sortedMediaBySizeASC = _.orderBy(parsedSize, "size", "asc");
        this.medias = sortedMediaBySizeASC;
        this.mediaSizeASC = false;
      } else {
        let sortedMediaBySizeDESC = _.orderBy(parsedSize, ["size"], "desc");
        this.medias = sortedMediaBySizeDESC;
        this.mediaSizeASC = true;
      }
    },
    orderByMediasName() {
      if (this.mediaNameASC) {
        let sortedMediaByNameASC = _.orderBy(
          this.medias,
          ["image_name"],
          "asc"
        );
        this.medias = sortedMediaByNameASC;
        this.mediaNameASC = false;
      } else {
        let sortedMediaByNameDESC = _.orderBy(
          this.medias,
          ["image_name"],
          "desc"
        );
        this.medias = sortedMediaByNameDESC;
        this.mediaNameASC = true;
      }
    },
    orderByMediaFileName() {
      if (this.mediaFileNameASC) {
        let sortedMediaByFileNameASC = _.orderBy(
          this.medias,
          ["image_database_name"],
          "asc"
        );
        this.medias = sortedMediaByFileNameASC;
        this.mediaFileNameASC = false;
      } else {
        let sortedMediaByFileNameDESC = _.orderBy(
          this.medias,
          ["image_database_name"],
          "desc"
        );
        this.medias = sortedMediaByFileNameDESC;
        this.mediaFileNameASC = true;
      }
    },
    toggleModal() {
      this.modal = !this.modal;
    },
    onUpdate() {
      this.modal = false;
      axios
        .get("http://127.0.0.1:8000/panel/main")
        .then((res) => (this.medias = res.data));
    },
    onDelete() {
      axios
        .get("http://127.0.0.1:8000/panel/main")
        .then((res) => (this.medias = res.data));
    },
  },
};
</script>

<style scoped>
.body {
  position: relative;
}

th {
  cursor: pointer;
  text-align: center;
}
</style>
