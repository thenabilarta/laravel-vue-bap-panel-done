<template>
  <div class="modal" v-if="showdata" @click.self="closeModal">
    <div class="modal-body">
      <div class="modal-body-image">
        <img
          :src="`storage/uploads/${showdata.image_database_name}`"
          alt="image"
          id="image-thumbnail"
        />
      </div>
      <div class="modal-body-text">
        <input
          type="text"
          v-if="imageString"
          :placeholder="imageString"
          v-model="form.name"
        />
        <button @click="formSubmit">Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ModalEdit",
  props: { showdata: Object },
  computed: {
    imageString() {
      if (this.showdata.image_name) {
        let name = this.showdata.image_name;
        let newName = name.split(".");
        return newName[0];
      }
    },
    angka() {
      if (this.showdata.media_id) {
        return this.showdata.media_id;
      }
    },
  },
  data() {
    return {
      form: {
        name: "",
        media_id: "",
      },
    };
  },
  watch: {
    showdata() {
      this.form.media_id = this.showdata;
    },
  },
  methods: {
    formSubmit() {
      axios
        .post("http://127.0.0.1:8000/panel/edit/store", this.form)
        .then((res) => console.log(res))
        .then(() => this.modalEditBind());
    },
    modalEditBind() {
      this.$emit("updateEdit");
    },
    closeModal() {
      this.$emit("closeModal");
    },
  },
};
</script>

<style scoped>
.modal {
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  position: fixed;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

#image-thumbnail {
  width: 120px;
  padding: 10px;
}

.modal-body {
  width: 500px;
  height: 300px;
  background-color: #f5f5f5;
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-body-text {
  height: 100px;
  justify-content: center;
  display: flex;
  align-items: center;
}

.modal-body-text input {
  outline: none;
  border: none;
  height: 3rem;
}

.modal-body-text button {
  height: 3rem;
}
</style>
