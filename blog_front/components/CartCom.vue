<template>
  <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex">
    <b-card
      :title="post.title"
      :img-src="mainImg"
      img-alt="Image"
      img-top
      tag="article"
      class="card m-2 d-flex"
      ><p class="text-muted">{{ dateUpdate }}</p>
      <b-card-text>
        <p class="badge badge-info">{{post.type}}</p>
        <br>
        {{ post.excerpt }}
      </b-card-text>
      <NuxtLink
        class="flex-end btn-outline-success text-center"
        :to="`/blog/${post.id}`"
        variant="btn"
        >Zobacz więcej</NuxtLink
      >
    </b-card>
  </div>
</template>

<script>
//import * as config from '@/store/config';
import moment from "moment";
import * as config from "~/store/cofig";

export default {
  props: {
    post: {
      type: Object,
      default: () => {},
    },
  },
  computed: {
    //https://
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
<style scoped>
.card-body {
  display: grid;
  grid-template-rows: auto 1fr auto;
}
</style>