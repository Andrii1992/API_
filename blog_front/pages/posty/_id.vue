<template >
  <div class="p-5 container position-relative">
    <div v-if="isLoading" class="img-load">
      <img
        class="img-load"
        :src="require('~/assets/img/icons/Spinner.svg')"
        alt=""
      />
    </div>
    <b-form
      @submit="submitData"
      enctype="multipart/form-data"
      method="POST"
      role="form"
    >
      {{ postData }}
      <b-form-group label="Status publikacji">
        <b-form-radio-group
          id="btn-radios-1"
          v-model="form.status"
          :options="options"
          name="status"
          buttons
        ></b-form-radio-group>
      </b-form-group>

      <div class="form-group">
        <label for="title">Nagłówek</label>
        <input
          type="text"
          class="form-control"
          name="title"
          v-model="form.title"
          placeholder="Nagłówek"
          required
        />
      </div>

      <b-form-group>
        <client-only placeholder="loading...">
          <ckeditor-nuxt v-model="form.content" :config="editorConfig" />
        </client-only>
      </b-form-group>

      <b-form-group>
        <img
          :src="mainImg(form.img)"
          alt=""
          class="mx-auto d-block"
          style="max-width: 50%"
          id="imgInpShowBig"
        />
        <h5 class="text-center">Duży obrazek</h5>
        <b-form-file
          accept="image/*"
          name="img"
          class="mt-3 text-center"
          v-model="file1"
          v-on:input="showIMGBig"
          id="imgInpB"
          plain
        ></b-form-file>
      </b-form-group>

      <b-form-group>
        <img
          id="imgInpShowSmall"
          :src="mainImg(form.img_thumb)"
          alt=""
          class="mx-auto d-block"
          style="max-width: 20%"
        />
        <h5 class="text-center">Mały obrazek</h5>
        <b-form-file
          id="imgInpS"
          accept="image/*"
          name="img_thumb"
          v-model="file2"
          v-on:input="showIMGSmall"
          class="mt-3 text-center"
          plain
        ></b-form-file>
      </b-form-group>
      <div class="form-group">
        <label for="excerpt">Krótki opis</label>
        <input
          type="text"
          class="form-control"
          name="excerpt"
          placeholder="Krótki opis"
          v-model="form.excerpt"
          required
        />
      </div>
      <div class="form-group">
        <label for="type">Temat</label>
        <input
          type="text"
          class="form-control"
          name="type"
          placeholder="Temat"
          v-model="form.type"
          id="topic"
        />
      </div>
      <b-button class="px-5" toggleable="lg" type="submit">Ok</b-button>
    </b-form>
  </div>
</template>

<script>
import * as config from "@/store/cofig";
import * as tmImage from "@teachablemachine/image";
export default {
  middleware: "auth",
  name: "EditPost",
  validate({ params }) {
    return /^\d+$/.test(params.id);
  },
  data() {
    return {
      form: {
        id: "",
        title: "",
        content: "",
        excerpt: "",
        type: "",
        status: 1,
        img: "",
        img_thumb: "",
      },
      file1: null,
      file2: null,
      options: [
        { text: "Opublikowana", value: 1 },
        { text: "Niepublikowana", value: 0 },
      ],
      editorConfig: {
        removePlugins: ["Title"],
      },
      isLoading: false,
    };
  },
  async fetch({ store, params }) {
    await store.dispatch("post/fetchEditShow", params.id);
  },
  computed: {
    postData() {
      this.form.id = this.$store.getters["post/post"].id;
      this.form.title = this.$store.getters["post/post"].title;
      this.form.content = this.$store.getters["post/post"].content;
      this.form.excerpt = this.$store.getters["post/post"].excerpt;
      this.form.type = this.$store.getters["post/post"].type;
      this.form.status = this.$store.getters["post/post"].status;
      this.form.img = this.$store.getters["post/post"].img;
      this.form.img_thumb = this.$store.getters["post/post"].img_thumb;
    },
  },
  methods: {
    submitData(event) {
      event.preventDefault();
      let formData = new FormData();
      formData.append("id", this.form.id);
      formData.append("title", this.form.title);
      formData.append("content", this.form.content);
      formData.append("excerpt", this.form.excerpt);
      formData.append("type", this.form.type);
      formData.append("status", this.form.status);
      if (this.file1 !== null) {
        formData.append("img", this.file1, this.file1.name);
      }
      if (this.file2 !== null) {
        formData.append("img_thumb", this.file2, this.file2.name);
      }
      this.$axios
        .$post("admin/posty/edycja", formData)
        .then(this.$router.push("/posty"))
        .catch((error) => {
          console.log(error);
        });
    },
    mainImg(pictures) {
      let img = "";

      if (pictures !== null && pictures !== undefined) {
        img = config.API_RESOURCES_URL + pictures;
      }
      return img;
    },
    showIMGBig() {
      const [file] = imgInpB.files;
      // tf.reset_default_graph()
      if (file) {
        this.model();
        imgInpShowBig.src = URL.createObjectURL(file);
      }
    },
    showIMGSmall() {
      const [file] = imgInpS.files;
      if (file) {
        imgInpShowSmall.src = URL.createObjectURL(file);
      }
    },

    async model() {
      if (topic.value.length === 0 && topic.value === "") {
        this.isLoading = true;
        let model;
        const modelURL = "/image-model/model.json";
        const modelMetaDataURL = "/image-model/metadata.json";
        model = await tmImage.load(modelURL, modelMetaDataURL);
        let img = document.getElementById("imgInpShowBig");
        const prediction = await model.predict(img);
        var info = this.getMaxIndex(prediction);
        this.form.type = prediction[info[0]].className;
        console.log("Rozpoznawanie zakończone");
        this.isLoading = false;
      }
    },
    getMaxIndex(array) {
      var element = [];
      for (let index = 0; index < array.length; index++) {
        element.push(parseFloat(array[index].probability.toFixed(5)));
      }
      let max = Math.max.apply(Math, element);
      return [element.indexOf(max), max];
    },
  },
  components: {
    "ckeditor-nuxt": () => {
      if (process.client) {
        return import("@blowstack/ckeditor-nuxt");
      }
    },
  },
};
</script>
<style>
.img-load {
  width: 100vw;
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  z-index: 999;
  height: 100%;
  overflow-y: auto;
}
.img-load svg {
  animation: 2s linear infinite svg-animation;
  max-width: 100px;
}

@keyframes svg-animation {
  0% {
    transform: rotateZ(0deg);
  }
  100% {
    transform: rotateZ(360deg);
  }
}

.img-load > circle {
  animation: 1.4s ease-in-out infinite both circle-animation;
  display: block;
  fill: transparent;
  stroke: #2f3d4c;
  stroke-linecap: round;
  stroke-dasharray: 283;
  stroke-dashoffset: 280;
  stroke-width: 10px;
  transform-origin: 50% 50%;
}

@keyframes circle-animation {
  0%,
  25% {
    stroke-dashoffset: 280;
    transform: rotate(0);
  }

  50%,
  75% {
    stroke-dashoffset: 75;
    transform: rotate(45deg);
  }

  100% {
    stroke-dashoffset: 280;
    transform: rotate(360deg);
  }
}
</style>