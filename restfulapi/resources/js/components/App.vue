<template>
  <div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container">
              <ul class="navbar-nav">
                  <router-link class="nav-item nav-link" :to="{name: 'home'}">Главная</router-link>
                  <router-link class="nav-item nav-link" :to="{name: 'desks'}">Доски</router-link>
              </ul>
          </div>
      </nav>
      <div class="container">
          <div>
              <router-view></router-view>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    // name: "App"
}
</script>

<style scoped>

</style>
