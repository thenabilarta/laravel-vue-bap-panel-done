<template>
  <div class="modal" @click.self="closeModal">
    <div v-if="failSendingImage" class="error-sending-image">
      Gagal menambahkan gambar
    </div>
    <form @submit="formSubmit" enctype="multipart/form-data">
      <!-- <div class="form-body">
        <input
          type="file"
          id="image"
          name="image"
          v-on:change="onFileChange"
          ref="file"
          multiple
        />
      </div> -->
      <div class="form-preview">
        <div class="form-preview-body-image">
          <div
            class="form-preview-body-image-image"
            v-for="(u, index) in url"
            :key="`u-${index}`"
          >
            <img :src="u" style="height: 100px; padding: 0 25px;" />
          </div>
        </div>
        <div class="form-preview-body-name">
          <div
            class="form-preview-body-name-name"
            v-for="(f, index) in userNamingImage"
            :key="`f-${index}`"
          >
            <div class="form-preview-body-name-name-text">
              <input
                type="text"
                v-model="form.parent_id[index]"
                :placeholder="f"
                v-if="f !== 'Done'"
              />
              <p>{{ f === "Done" ? "Done" : "" }}</p>
            </div>
            <div class="form-preview-body-name-name-button">
              <p class="upload-button" @click="uploadSingle(f)">Upload</p>
              <p class="remove-button" @click="removeSingle(f)">Remove</p>
            </div>
          </div>
        </div>
      </div>
      <div class="navigation">
        <label class="addimageslabel btn-info btn" for="image"
          >Add Images</label
        >
        <input
          type="file"
          id="image"
          class="input-file"
          name="image"
          v-on:change="onFileChange"
          ref="file"
          multiple
        />
        <button class="add-button btn btn-primary">Upload All</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import _ from "lodash";
export default {
  name: "Modal",
  data() {
    return {
      file: [],
      url: [],
      kotak: [],
      imageName: "",
      failSendingImage: false,
      userNamingImage: [],
      form: {
        parent_id: [],
      },
    };
  },
  watch: {
    form: function() {
      console.log(this.form);
    },
  },
  methods: {
    uploadSingle(f) {
      console.log("Uploading " + f);
      for (let i = 0; i < this.file.length; i++) {
        if (this.file[i].name === f + ".jpg") {
          console.log(this.file[i].name);
          let formData = new FormData();
          formData.append("file", this.file[i]);
          formData.append(
            "imageName",
            this.form.parent_id[i] ? this.form.parent_id[i] : "Testing gan"
          );
          const config = {
            headers: { "content-type": "multipart/form-data" },
          };
          axios
            .post("http://127.0.0.1:8000/panel/addmedia", formData, config)
            .then(function(response) {
              console.log(response);
            })
            // .then(() => (this.userNamingImage[i] = "Done"))
            .then(() => Vue.set(this.userNamingImage, i, "Done"))
            .then(() => this.testBind())
            .catch((err) => (this.failSendingImage = true));
        }
      }
    },
    removeSingle(f) {
      console.log("Removing " + f);
      for (let i = 0; i < this.userNamingImage.length; i++) {
        if (this.userNamingImage[i] === f) {
          // console.log(this.file[i].name);
          this.userNamingImage.splice(i, 1);
          this.url.splice(i, 1);
          this.file.splice(i, 1);
        }
      }
      console.log(this.userNamingImage);
    },
    closeModal() {
      this.$emit("closeModal");
      console.log(this.file);
      this.file = [];
    },
    async onFileChange(e) {
      // console.log(e.target.files[1]);
      let i = 0;
      for (i = 0; i < e.target.files.length; i++) {
        // console.log(e.target.files[i]);
        this.file.push(e.target.files[i]);
        this.url.push(URL.createObjectURL(e.target.files[i]));
        // this.fileImageName.push(e.target.files[i].name);
        // console.log(this.file);
        // console.log(this.url);
      }
      console.log(this.file);
      console.log(this.url);
      Array.from(this.file).map((f) => {
        let imageNameFetched = f.name;
        let imageNameFetchedOnly = imageNameFetched.substr(
          0,
          imageNameFetched.lastIndexOf(".")
        );
        this.userNamingImage.push(imageNameFetchedOnly);
      });
      // console.log(this.fileImageName);
      // this.file = e.target.files;
      // console.log(this.file);
      // console.log(e.target.files[0].name);
      // this.file = e.target.files[0];
      // this.imageName = e.target.files[0].name;
      // this.kotak = [...this.file];
      // console.log(this.kotak);
      // this.url = URL.createObjectURL(this.file);
    },
    testBind() {
      this.$emit("update");
    },
    uploadImages() {
      const promises = Array.from(this.file).map((f, index) => {
        let imageName = f.name;
        let imageNameOnly = imageName.substr(0, imageName.lastIndexOf("."));
        const config = {
          headers: { "content-type": "multipart/form-data" },
        };
        let formData = new FormData();
        formData.append("file", f);
        // formData.append(
        //   "imageName",
        //   this.form.parent_id[index]
        //     ? this.form.parent_id[index]
        //     : imageNameOnly
        // );
        return axios
          .post("http://127.0.0.1:8000/panel/addmedia", formData, config)
          .then(function(response) {
            console.log(response);
          })
          .catch((err) => (this.failSendingImage = true));
      });
      return Promise.all(promises);
    },
    async formSubmit(e) {
      e.preventDefault();
      // if (this.file.length === 0) {
      //   return console.log("Masukkan image");
      // }
      await this.uploadImages();
      await this.testBind();
      // console.log(this.file[0]);
      // const config = {
      //   headers: { "content-type": "multipart/form-data" },
      // };
      // let formData = new FormData();
      // formData.append("file", this.file[i]);
      // console.log(this.file[i]);
      // axios
      //   .post("http://127.0.0.1:8000/panel/addmedia", formData, config)
      //   .then(function(response) {
      //     console.log(response);
      //   });
      // axios
      //   .post("http://127.0.0.1:8000/panel/addmedia", formData, config)
      //   .then(function(response) {
      //     console.log(response);
      //   });
      // .then(() => this.testBind())
      // .catch(function(error) {
      //   currentObj.output = error;
      // });
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
  min-height: 300px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.error-sending-image {
  position: absolute;
  background-color: lawngreen;
  z-index: 5;
  opacity: 0.9;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
form {
  width: 80%;
  height: 80%;
  background-color: #f5f5f5;
  position: absolute;
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-direction: column;
}
/* .form-body {
  height: 20%;
  width: 80%;
  background-color: white;
  position: relative;
  cursor: pointer;
  margin: 3rem auto;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px dotted black;
} */
/* .form-body:hover {
  background-color: #f5f5f5;
} */
.form-preview {
  height: 75%;
  min-width: 90%;
  background-color: white;
  display: flex;
  overflow-y: scroll;
}
.form-preview-body-image {
  display: flex;
  flex: 1 1 0;
  flex-direction: column;
}
.form-preview-body-name {
  display: flex;
  flex: 3 1 0;
  flex-direction: column;
}
.form-preview-body-image-image {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0.2rem 0;
  height: 100px;
}
.form-preview-body-name-name {
  min-height: 100px;
  padding: 0.2rem 0;
  display: flex;
  width: 100%;
}
.form-preview-body-name-name-text {
  width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.form-preview-body-name-name-button {
  width: 50%;
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.upload-button {
  margin: 0 !important;
  cursor: pointer;
}
.remove-button {
  cursor: pointer;
}
.input-file {
  opacity: 0;
  display: none;
}
/* .button-input {
  height: 30px;
  width: 100px;
  cursor: pointer;
  position: relative;
} */
.navigation {
  display: flex;
  justify-content: space-around;
  width: 50%;
  align-items: center;
}
.addimageslabel {
  margin-bottom: 0px !important;
  font-weight: normal !important;
  cursor: pointer;
}
/* .add-button {
  margin: 2rem auto;
} */
</style>
