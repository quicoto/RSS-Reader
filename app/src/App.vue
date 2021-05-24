<template>
  <div class="app">
    <b-container fluid>
      <b-row class="text-light pb-4 pt-4">
        <b-col cols="12" offset-md="3" md="9">
          <h1 class="h3 m-0"><b-icon icon="rss-fill" class="mr-1"></b-icon> RSS Reader</h1>
        </b-col>
      </b-row>
      <b-row class="text-light pb-4">
        <b-col cols="12" md="3">
          <ul>
            <li>
              <a href="<?=$site_path?>/index.php?starred=1">Starred</a>
            </li>
            <li>
              <a href="<?=$site_path?>/index.php?unread=1">Unread</a>
            </li>
            <li>
              <a href="<?=$site_path?>/index.php?all=1">All</a>
            </li>
          </ul>
        </b-col>
        <b-col cols="12" md="9" lg="7" xl="6">
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
export default {
  name: 'App'
}
</script>

<style lang="scss">
@import '~bootstrap/scss/_functions';
@import '~bootstrap/scss/_variables';

h1, h2, h3, h4, h5 {
  font-weight: 300 !important;
}

.pointer { cursor: pointer; }
</style>