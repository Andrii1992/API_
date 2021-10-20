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
      <div v-if="userData.data">
        <p class="badge badge-secondary">Liczba rekordów: <span class="badge badge-light"> {{ userData['total'] }}
        </span></p>
        <div v-if="userData['total']">
          <table class="table table-striped table-secondary rounded-bottom">
            <thead>
              <tr>
                <th scope="col">Imię</th>
                <th scope="col">Email</th>
                <th scope="col">Data utworzenia</th>
                <th scope="col">Data aktualizacji</th>
                <th scope="col">Rola</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="dat in userData.data" :key="dat.id">
                <td>{{ dat.name }}</td>
                <td>{{ dat.email }}</td>
                <td>{{ dateUpdate(dat.created_at) }}</td>
                <td>{{ dateUpdate(dat.updated_at) }}</td>
                <td>
                  <div v-if="dat.roles.length">
                    <div v-if="dat.roles[0].name === 'admin'">
                      <div class="badge badge-success">
                        {{ dat.roles[0].name }}
                      </div>
                    </div>
                    <div v-else>
                      <div class="badge badge-info">
                        {{ dat.roles[0].name }}
                      </div>
                    </div>
                  </div>
                  <div v-else><div class="badge badge-warning">brak</div></div>
                </td>

                <td>
                  <a
                    class="btn text-dark d-flex justify-content-center"
                    @click="getDelete(dat.id)"
                    >usuń</a
                  >
                </td>
                <td>
                  <NuxtLink class="btn" :to="`/uzytkowniki/${dat.id}`"
                    >edytuj</NuxtLink
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-else>
          <h1 class="text-success font-weight-bold text-center">Brak użytkowników</h1>
        </div>
      </div>

      <div class="mt-3 mb-3">
        <div class="col d-flex flex-row flex-wrap">
          <pagination
            class="m-auto justify-content-center flex-wrap"
            size="large"
            :data="userData"
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

<style>
@import url("https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans&family=Oswald:wght@200;300;400;500;600;700&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Anton&family=Goblin+One&family=Itim&family=Merriweather+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap");

.wrapper {
  font-family: "Oswald", sans-serif;
}

aside {
  font-family: "Itim", cursive;
}
</style>
<script>
import moment from "moment";
export default {
  middleware: "isadmin",
  name: "Users",
  mounted() {
    this.getResults();
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
        { value: "name", text: "imieniu" },
      ],
      optionsRecords: [
        { value: 10, text: "10" },
        { value: 15, text: "15" },
      ],
    };
  },
  computed: {
    userData() {
      return this.$store.getters["users/users"];
    },
  },
  methods: {
    async getResults(page = 1) {
      this.$store.dispatch("users/fetch", {
        page: page,
        ser: this.ser,
        sort: this.sort,
        by: this.by,
        records: this.records,
      });
    },
    dateUpdate(date) {
      return moment(date).format("MM/DD/YYYY hh:mm");
    },
    getDelete(id) {
      if (confirm("Czy napewno usunąć?")) {
        this.$axios
          .get("admin/uzytkowniki/usun/" + id)
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
