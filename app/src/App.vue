<template>
  <div class="app">
    <b-container fluid>
      <b-row class="text-light pb-4 pt-4">
        <b-col cols="9" offset-md="3" md="9">
          <h1 class="h3 m-0">
            <b-icon icon="rss-fill" class="mr-2 site-icon"></b-icon>
            <a href="/" class="text-white text-decoration-none">RSS Reader</a>
          </h1>
        </b-col>
        <b-col cols="3" class="d-block d-md-none text-right">
          <b-icon v-show="!isNavigationOpen" @click="isNavigationOpen = !isNavigationOpen" font-scale="2" icon="justify"></b-icon>
          <b-icon v-show="isNavigationOpen" @click="isNavigationOpen = !isNavigationOpen" font-scale="2" icon="plus" class="close-navigation"></b-icon>
        </b-col>
      </b-row>
      <b-row class="text-light pb-4">
        <b-col cols="12" md="3" lg="2" class="mb-3 navigation" v-show="isNavigationOpen">
          <Sidebar />
        </b-col>
        <b-col cols="12" offset-lg="1" md="9" lg="7" xl="6">
          <div class="rounded bg-light text-dark p-3 mb-4">
            <router-view></router-view>
          </div>
        </b-col>
      </b-row>
      <b-row class="text-light pb-4">
        <b-col cols="12" offset-md="3" md="9">
          Created with <b-icon icon="heart-fill"></b-icon> by <a href="https://ricard.blog/" class="">Ricard Torres</a>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Sidebar from './components/Sidebar.vue'

export default {
  name: 'App',
  components: {
    Sidebar
  },
  data: function () {
    return {
      isNavigationOpen: false
    }
  }
}
</script>

<style lang="scss">
@import '~bootstrap/scss/_functions';
@import '~bootstrap/scss/_variables';

h1, h2, h3, h4, h5 {
  font-weight: 300 !important;
}

.pointer { cursor: pointer; }

.site-icon {
  background: white;
  border-radius: 15px;
  color: #f39c12;
}

.close-navigation {
  transform: rotate(45deg);
}

@media (min-width: 768px) {
  .navigation { display: block !important; }
}
</style>