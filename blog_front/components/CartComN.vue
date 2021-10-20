<template>
  <div class="col-12 col-md-6 col-lg-4 col-xl-4 d-flex justify-content-center">
    <NuxtLink
      :to="`/blog/${post.id}`"
      class="card bg-dark text-white shadow-sm border-0"
    >
      <img
        class="card-img"
        style="opacity: 0.25"
        :src="mainImg"
        alt="Card image"
      />
      <div class="card-img-overlay d-flex flex-column align-items-start">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text mt-auto">{{ post.excerpt }}</p>
        <span class="badge badge-danger font-weight-normal mr-2">{{
          dateUpdate
        }}</span>
        {{ post.type }}
      </div>
    </NuxtLink>
  </div>
</template>

<script>
import * as config from "~/store/cofig";
import moment from "moment";

export default {
  props: {
    post: {
      type: Object,
      default: () => {},
    },
  },
  computed: {
    mainImg() {
      const pictures = this.post.img_thumb;

      let img = "";

      if (pictures === null || pictures === undefined) {
        img = require(`~/assets/img/gallery/no-photo.png`);
      } else {
        img = config.API_RESOURCES_URL + pictures;
      }
      return img;
    },
    dateUpdate() {
      return moment(this.post.updated_at).startOf("hour").fromNow();
    },
  },
};
</script>

<style>
</style>