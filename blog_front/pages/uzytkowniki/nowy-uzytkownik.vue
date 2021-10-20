<template >
  <div class="p-5 container">
    <ValidationObserver>
      <b-form
        @submit="submitData"
        enctype="multipart/form-data"
        method="POST"
        role="form"
        class=""
      >
        <div class="form-group">
          <label for="name">Imię</label>
          <input
            type="text"
            class="form-control"
            name="name"
            placeholder="Imię"
            v-model="form.name"
            required
          />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            class="form-control"
            name="email"
            placeholder="Email"
            v-model="form.email"
            required
          />
        </div>

        <ValidationProvider
          rules="required|password:@confirm|min:6"
          v-slot="{ errors }"
        >
          <div class="form-group">
            <label for="excerpt">Hasło</label>
            <input
              type="password"
              class="form-control"
              name="password"
              placeholder="Hasło"
              v-model="form.password"
            />
            <span>{{ errors[0] }}</span>
          </div>
        </ValidationProvider>

        <ValidationProvider name="confirm" rules="required" v-slot="{ errors }">
          <div class="form-group">
            <label for="password">Potwierdź hasło</label>
            <input
              type="password"
              name="password_confirmation"
              class="form-control"
              placeholder="Hasło"
              v-model="form.password_confirmation"
            />
            <span>{{ errors[0] }}</span>
          </div>
        </ValidationProvider>

        <div class="form-group">
          <label for="excerpt">Rola</label>
          <b-form-select v-model="form.role" :options="options"></b-form-select>
        </div>

        <b-button class="px-5" toggleable="lg" type="submit">Ok</b-button>
      </b-form>
    </ValidationObserver>
  </div>
</template>

<script>
import { extend } from "vee-validate";

extend("password", {
  params: ["target"],
  validate(value, { target }) {
    return value === target;
  },
  message: "Hasła muszą się zgadzać",
});
export default {
  middleware: "isadmin",
  name: "NewUser",
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        role: "user",
      },
      options: [
        { value: "user", text: "Użytkownik" },
        { value: "admin", text: "Admin" },
        { value: "brak", text: "brak" },
      ],
      errors: [],
    };
  },

  methods: {
    submitData(event) {
      event.preventDefault();
      this.$axios
        .$post("admin/uzytkowniki/nowy", this.form)
        .then(this.$router.push("/uzytkowniki"))
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
