

<template>
  <div class="error page-wrap d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 text-center">
          <h1 class="display-1 d-block text-success font-weight-bold">404</h1>
          <div class="mb-4 lead font-weight-bold">
            Strona nie została znaleziona
          </div>
          <NuxtLink to="/" class="btn btn-link text-success font-weight-bold"
            >Powrót na stronę główną</NuxtLink
          >
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.error h1 {
  font-size: 10rem;
}
</style>