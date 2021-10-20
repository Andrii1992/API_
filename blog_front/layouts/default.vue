<template>
  <div style="overflow-x: hidden">
    <b-navbar toggleable="lg" type="dark" class="mb-0" variant="dark">
      <b-navbar-brand to="/">Strona domowa</b-navbar-brand>
      <b-navbar-brand to="/blog">Blog</b-navbar-brand>
      
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav class="ml-auto">
        <template v-if="$auth.loggedIn">
          <b-nav-item-dropdown right>
            <template #button-content> Posty </template>
            <b-dropdown-item to="/posty">Posty</b-dropdown-item>
            <b-dropdown-item to="/posty/nowy-post">Nowy post</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown right v-if="$auth.user.role === 'admin'">
            <template #button-content> Użytkowniki </template>
            <b-dropdown-item to="/uzytkowniki">Użytkowniki</b-dropdown-item>
            <b-dropdown-item to="/uzytkowniki/nowy-uzytkownik"
              >Nowy użytkownik</b-dropdown-item
            >
          </b-nav-item-dropdown>

          <b-nav-item-dropdown right>
            <!-- Using 'button-content' slot -->

            <template #button-content> {{ $auth.user.name }} </template>
            <b-dropdown-item href="#" @click.prevent="logout()"
              >Wyloguj</b-dropdown-item
            >
          </b-nav-item-dropdown>
        </template>
        <template v-else>
          <b-nav-item to="/login">Zaloguj się</b-nav-item>
        </template>
      </b-navbar-nav>
      </b-collapse>
    </b-navbar>

    <Nuxt />
  </div>
</template>

<script>
export default {
  methods: {
    async logout() {
      try {
        await this.$auth.logout();
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans&family=Oswald:wght@200;300;400;500;600;700&display=swap");

h1,
h2,
h3,
h4,
h5,
p,
a {
  font-family: "Oswald", sans-serif;
  font-weight: 400;
}

.page-enter-active,
.page-leave-active
.layout-enter-active, 
.layout-leave-active {
  transition: filter .3s ease;
}
.page-enter,
.page-leave-active,
.layout-enter, 
.layout-leave-active {
   filter: blur(50px);
   transition: filter 0.3s ease;
}

#app{
  max-width: 2000px;
  display: block;
  margin: 0 auto !important;
  transition-duration:4s;
}

@keyframes animBlock {
  0% {
    filter: grayscale(10%);
  }
  100% {
    filter: grayscale(0.5) blur(10px);
  }
}

*::after,
*::before {
  box-sizing: border-box;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  text-align: center;
  color: #2c3e50;
  overflow: hidden;
  min-height: 100vh;
  display: grid;

  grid-template-rows: auto 1fr auto;
}

#nav,
#navf {
  padding: 30px;
  background-color: #212529;
}

#nav a {
  font-weight: bold;
  color: white;
}

.posts .btn-outline-success:hover{
  color: white;
  text-decoration: none;

}

.nuxt-link-exact-active.nuxt-link-active {
  color: #38c172 !important;

}
/* post */

.post .card-img,
.post .card-img-top {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}


.post .card {
  border: 0;
  border-radius: 0;
}

.post .card-img,
.post .card-img-bottom {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.post .card-img-overlay {
    top: auto !important;
    background-color: rgba(0,0,0,0.5);
}
.post .card-img-overlay h4{
  font-size: 60px;
  color: #38c172;
}

.post h2{
  font-size: 40px;
}


.post p {
    text-align: justify;    
}



@media(max-width:767px) {
  .post .card-img-overlay h4 {
    font-size: 7vw;
  }
  .post h2{
    font-size: 6vw;
  }
  .post p {
    font-size: 5vw;
  }
}

/* posty */

.page-item.active .page-link {
  background-color: #212529 !important;
  border-color: #212529 !important;
}

 .page-link {
  color: #212529 !important;
}

 .active .page-link{
  color: white !important;
}

 .btn-outline-success {
  color: #28a745;
  border-color: #28a745;
  border: 2px #28a745 solid;
  border-radius: 5px;
  padding: 5px;
}
</style>
