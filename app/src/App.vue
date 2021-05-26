<template>
  <div class="app">
    <b-container fluid>
      <b-row class="text-light pb-4 pt-4">
        <b-col cols="9" offset-md="3" md="9">
          <h1 class="h3 m-0">
            <b-icon icon="rss-fill" class="mr-1 site-icon"></b-icon>
            <router-link to="/" class="text-white text-decoration-none">RSS Reader</router-link>
          </h1>
        </b-col>
        <b-col cols="3" class="d-block d-md-none text-right">
          <b-icon v-show="!isNavigationOpen" @click="isNavigationOpen = !isNavigationOpen" font-scale="2" icon="justify"></b-icon>
          <b-icon v-show="isNavigationOpen" @click="isNavigationOpen = !isNavigationOpen" font-scale="2" icon="plus" class="close-navigation"></b-icon>
        </b-col>
      </b-row>
      <b-row class="text-light pb-4">
        <b-col cols="12" md="3" lg="2" class="mb-3 navigation" v-show="isNavigationOpen">
          <h5>Filter</h5>
          <b-list-group class="mb-4">
            <b-list-group-item variant="primary" to="<?=$site_path?>/index.php?unread=1">Unread only</b-list-group-item>
            <b-list-group-item variant="warning" to="<?=$site_path?>/index.php?starred=1">Starred only</b-list-group-item>
            <b-list-group-item variant="info" to="<?=$site_path?>/index.php?all=1">All items</b-list-group-item>
          </b-list-group>

          <h5>Add new feed</h5>
          <b-form @submit="onSubmit" class="mb-4">
            <b-form-input
              id="feed-url"
              v-model="newFeedUrl"
              type="url"
              placeholder="example.com/rss.xml"
              required
              class="mb-2"
            ></b-form-input>

            <b-alert class="mb-2" :show="addSuccess" variant="success"><b-icon icon="emoji-smile" class="mr-1"></b-icon> Feed has been added</b-alert>
            <b-alert class="mb-2" :show="addFail" variant="danger"><b-icon icon="emoji-wink" class="mr-1"></b-icon> Feed was already added</b-alert>

            <b-button type="submit" block variant="primary">Add feed</b-button>
          </b-form>

          <router-link to="/" class="text-white text-decoration-none">
            <b-icon icon="gear-fill" class="mr-1"></b-icon>
            Manage Feeds
          </router-link>
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
import { endpoints } from '@/values';

export default {
  name: 'App',
  data: function () {
    return {
      newFeedUrl: '',
      addSuccess: false,
      addFail: false,
      isNavigationOpen: false
    }
  },
  methods: {
    onSubmit: function (event) {
      event.preventDefault();

      const params = `?url=${encodeURIComponent(this.newFeedUrl)}`

      fetch(`${window.rss_reader.apiUrl}${endpoints.addFeed}${params}`)
        .then(response => response.json())
        .then((data) => {
          if (data === 0) {
            this.addFail = true;
            this.addSuccess = false;
          }

          if (data === 1) {
            this.addFail = false;
            this.addSuccess = true;
          }

          this.newFeedUrl = '';
        });
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