<template>
  <div class="app">
    <b-container fluid>
      <b-row class="text-light pb-4 pt-4">
        <b-col cols="12" offset-md="3" md="9">
          <h1 class="h3 m-0"><b-icon icon="rss-fill" class="mr-1"></b-icon> RSS Reader</h1>
        </b-col>
      </b-row>
      <b-row class="text-light pb-4">
        <b-col cols="12" md="3" lg="2" class="mb-3">
          <ul>
            <li>
              <a href="<?=$site_path?>/index.php?starred=1">Starred only</a>
            </li>
            <li>
              <a href="<?=$site_path?>/index.php?unread=1">Unread only</a>
            </li>
            <li>
              <a href="<?=$site_path?>/index.php?all=1">All item</a>
            </li>
            <li>
              Feeds
            </li>
          </ul>

           <b-form @submit="onSubmit">
            <b-form-group
              id="input-group-1"
              label="Add new feed"
              label-for="feed-url"
            >
              <b-form-input
                id="feed-url"
                v-model="newFeedUrl"
                type="url"
                placeholder="example.com/rss.xml"
                required
              ></b-form-input>
            </b-form-group>

            <b-alert :show="addSuccess" variant="success">Feed has been added</b-alert>
            <b-alert :show="addFail" variant="danger">Feed was already added</b-alert>

            <b-button type="submit" block variant="primary">Add feed</b-button>
          </b-form>
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
</style>