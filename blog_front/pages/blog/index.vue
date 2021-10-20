<template>
  <div class="py-3 px-1 px-lg-5  posts">

    <div v-if="postsList">
      <div class="row d-flex flex-wrap">
        <Cart v-for="row in postsList.data" :key="row.id" :post="row" />
      </div>
    </div>
    <div v-else><h1>Brak postów</h1></div>
    <div class="row mt-3 mb-3">
            <div class="col d-flex flex-row flex-wrap">
              <pagination
                class="m-auto justify-content-center flex-wrap"
                size="large"
                :data="postsList"
                @pagination-change-page="getResults"
              >
                <span slot="prev-nav">&lt;</span>
                <span slot="next-nav">&gt;</span>
              </pagination>
            </div>
          </div>

          
  </div>
</template>
<script>
import Cart from "@/components/CartCom.vue";

export default {

  name: "Posts",
  components: {
    Cart,
  },
	data() {
		return {
			postsList: {},
		}
	},
	mounted() {
		this.getResults();
	},

	methods: {
		getResults(page = 1) {
			this.$axios.get('/blog?page=' + page)
				.then(response => {
					this.postsList = response.data.posts;

				}).catch(() => {})
		}
	}

}
</script>
