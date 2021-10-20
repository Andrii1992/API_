<template >
  <div class="post"> 

    <b-card
      overlay
      :img-src="mainImg"
      img-alt="Card Image"
      text-variant="black"
      :title="post.title"
      :sub-title="dateUpdate"
    >
    </b-card>
    <div class="container py-lg-4 py-2 px-lg-0 px-3 " v-html="post.content"></div>

    <div class="container py-lg-4 py-2 px-lg-0 px-3 " v-html="latestPosts.content"></div>
    <div v-if="latestPosts">
      <div class="row d-flex mb-0 flex-wrap">
        <Cart v-for="row in latestPosts" :key="row.id" :post="row" />
      </div>
    </div>
  </div>
</template>

<script>
import * as config from '@/store/cofig';
import Cart from "@/components/CartComN.vue";
import moment from 'moment';
export default {
  name: "Post",
  components: {
    Cart,
  },
   validate({ params }) {
    return /^\d+$/.test(params.id);
  },
    async asyncData ({ $axios, store, params }) {
  //  store.commit('getByIdPost', false)
 
    const { post, latestPosts } = await $axios.$get('/blog/' + params.id)
    
    return { post, latestPosts }
  },
  computed: {
    mainImg () {
    
      // console.log()
      //const pictures = null;
      
      const pictures = this.post.img;
      
      let img = ''
      if (pictures === null) {
        img = require(`~/assets/img/gallery/no-photo.png`);
      } else {
        img =
          config.API_RESOURCES_URL +
          pictures
      }
      return img
    },
     dateUpdate(){
      return moment(this.post.updated_at).subtract(10, 'days').calendar();
    }
  }
  /*
  computed: {
    postData() {
      return  this.$store.getters.GET_POST_DATA; //  this.$store.getters.GET_POST_DATA;
    },
    latestPostData() {
      return this.$store.getters.GET_LATEST_POST_DATA;
    },
    postsLoading() {
      return this.$store.getters.GET_POST_LADING;
    },
    postsError() {
      return this.$store.getters.GET_POST_ERROR;
    },
    mainImg() {
      const pictures = this.$store.getters.GET_POST_DATA.img;
      let img = "";
      if (pictures === null || pictures === undefined) {
        img = require("@/assets/img/gallery/no-photo.png");
      } else {
        img = config.API_RESOURCES_URL + pictures;
      }
      return img;
    }, 
    dateUpdate(){
      return moment(this.$store.getters.GET_POST_DATA.updated_at).subtract(10, 'days').calendar();
    }
  },
  created() {
    this.$store.dispatch("FETCH_POST", this.$route.params.id);
  },*/
};
</script>
