<template>
  <div>
    <b-overlay
      :show="showLoading"
      spinner-variant="dark"
      spinner-type="grow"
      spinner-small
      rounded="sm"
    >
      <h1>Feeds</h1>
      <b-list-group>
        <b-list-group-item
          class="d-flex justify-content-between align-items-center"
          v-for="feed in feeds"
          v-bind:key="feed.id">
          <div>
            <p class="mb-1"><strong>{{ feed.title }}</strong></p>
            <p class="mb-0"><a :href="feed.url" :title="feed.title">{{ feed.url }}</a></p>
          </div>
          <b-button variant="danger" @click="deleteFeed(feed.id)">Delete</b-button>
        </b-list-group-item>
      </b-list-group>
    </b-overlay>
  </div>
</template>

<script>
import { endpoints } from '@/values';

export default {
  name: 'Feeds',
  data: function() {
    return {
      feeds: [],
      showLoading: true
    }
  },
  methods: {
    fetchResources: function() {
      this.showLoading = true;

      fetch(`${window.rss_reader.apiUrl}${endpoints.feeds}`)
        .then(response => response.json())
        .then(feeds => {
          this.feeds = feeds;
          this.showLoading = false;
        });
    },
    deleteFeed: function(id) {
      const params = `?id=${id}`

      fetch(`${window.rss_reader.apiUrl}${endpoints.deleteFeed}${params}`)
        .then(() => {
          this.fetchResources();
        });
    },
  },
  created: function() {
    this.fetchResources();
  }
}
</script>