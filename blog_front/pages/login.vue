<template>
  <b-container>
    <b-row>
      <b-col cols="6" class="mx-auto mt-5">
        <b-form @submit="login" @reset="onReset" v-if="show">
          <div v-if="error">
            <p class="border my-2 p-2 text-danger border-danger">
              Nie udało się zalować
            </p>
          </div>
          <b-form-group id="input-group-1" label="Email:" label-for="input-1">
            <b-form-input
              id="input-1"
              v-model="form.email"
              type="email"
              placeholder="Email"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-2" label="Hasło" label-for="input-2">
            <b-form-input
              type="password"
              id="input-2"
              v-model="form.password"
              placeholder="Hasło"
              aria-describedby="password-help-block"
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-4" v-slot="{ ariaDescribedby }">
            <b-form-checkbox-group
              v-model="form.checked"
              id="checkboxes-4"
              :aria-describedby="ariaDescribedby"
            >
              <b-form-checkbox value="remember">Zapamiętaj</b-form-checkbox>
            </b-form-checkbox-group>
          </b-form-group>

          <b-button class="mt-2" toggleable="lg" type="submit">Zaloguj się</b-button>
          <b-button class="mt-2" toggleable="lg" type="reset">Wyczyść</b-button>
        </b-form>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  //  middleware: ["guest"],
  data() {
    return {
      form: {
        email: "",
        password: "",
        checked: [],
      },
      show: true,
      error: false,
    };
  },

  methods: {
    login(event) {
      event.preventDefault();
      this.$auth
        .loginWith("laravelSanctum", {
          data: this.form,
        })
        .then(console.log("Login"))
        .catch((error) => {
          console.log(error);
          this.error = true;
        });
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      this.form.email = "";
      this.form.password = "";
      this.form.checked = [];
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
  },
};
</script>
