<template>
  <div class="table-responsive rounded-top mb-0">
    <div class="container py-2">
      <b-row>
        <b-col class="pb-2" sm="12">
          <b-form-input
            placeholder="Wyszukaj"
            type="text"
            v-model="ser"
            @input="getResults(1)"
          >
          </b-form-input>
        </b-col>

        <b-col sm="4">
          <b-form-group label="Kolejność" label-cols-sm="4">
            <b-form-select
              @input="getResults(1)"
              v-model="sort"
              :options="optionsSort"
            ></b-form-select>
          </b-form-group>
        </b-col>
        <b-col sm="4">
          <b-form-group label="Sortuj po" label-cols-sm="4">
            <b-form-select
              @input="getResults(1)"
              v-model="by"
              :options="optionsBy"
            ></b-form-select>
          </b-form-group>
        </b-col>
        <b-col sm="4">
          <b-form-group label="Na stronie rekordów" label-cols-sm="6">
            <b-form-select
              @input="getResults(1)"
              v-model="records"
              :options="optionsRecords"
            ></b-form-select>
          </b-form-group>
        </b-col>
      </b-row>
     
      <div v-if="postsData.data">
        <p class="badge badge-secondary">Liczba rekordów: <span class="badge badge-light "> {{postsData["total"]}}</span></p>
        <div v-if="postsData['total']">
          <table class="table table-striped table-secondary rounded-bottom">
            <thead>
              <tr>
                <th scope="col">Nagłówek</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Status</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="dat of postsData.data" :key="dat.id">
                <td colspan="4">{{ dat.title }}</td>
                <td></td>
                <td></td>
                <td>
                  <div v-if="dat.status">
                    <div class="badge badge-success">Opublikowany</div>
                  </div>
                  <div v-else>
                    <div class="badge badge-info">Prywatny</div>
                  </div>
                </td>
                <td>
                  <a
                    type="button ml-auto"
                    class="btn text-dark d-flex justify-content-end"
                    @click="getDelete(dat.id)"
                    >usuń</a
                  >
                </td>
                <td>
                  <NuxtLink
                    class="btn btn text-dark d-flex justify-content-end"
                    :to="`/posty/${dat.id}`"
                    >edytuj</NuxtLink
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else>
          <h1 class="text-success font-weight-bold text-center">Brak postów</h1>
        </div>
      </div>
      <div class="mt-3 mb-3">
        <div class="col d-flex flex-row flex-wrap">
          <pagination
            class="m-auto justify-content-center flex-wrap"
            size="large"
            :data="postsData"
            @pagination-change-page="getResults"
          >
            <span slot="prev-nav">&lt;</span>
            <span slot="next-nav">&gt;</span>
          </pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Cart from "@/components/CartCom.vue";
export default {
  middleware: "auth",
  name: "Posts",
  components: {
    Cart,
  },
  data() {
    return {
      ser: "",
      sort: "desc",
      by: "created_at",
      records: 10,
      optionsSort: [
        { value: "asc", text: "rosnąca" },
        { value: "desc", text: "malejąca" },
      ],
      optionsBy: [
        { value: "created_at", text: "dacie utworzenia" },
        { value: "title", text: "nagłówku" },
      ],
      optionsRecords: [
        { value: 10, text: "10" },
        { value: 15, text: "15" },
      ],
    };
  },
  mounted() {
    this.getResults();
  },
  computed: {
    postsData() {
      return this.$store.getters["posts/posts"];
    },
  },
  methods: {
    async getResults(page = 1) {
      this.$store.dispatch("posts/fetch", {
        page: page,
        ser: this.ser,
        sort: this.sort,
        by: this.by,
        records: this.records,
      });
    },
    getDelete(id) {
      if (confirm("Czy napewno usunąć?")) {
        this.$axios
          .get("admin/posty/usun/" + id)
          .then(() => {
            location.reload();
          })
          .catch((err) => {
            this.data = err;
          });
      }
    },
  },
};
</script>
