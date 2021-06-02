<template>
  <div>
    <b-overlay
      :show="showLoading"
      spinner-variant="dark"
      spinner-type="grow"
      rounded="sm"
    >
      <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-3">{{ this.title }} <span v-if="items.length > 0">({{items.length}})</span></h1>
        <b-button variant="success" @click="markAllAsRead()" v-show="items.length > 0">
          Read all
          <b-icon class="mr-1" icon="check"></b-icon>
        </b-button>
      </div>
      <b-alert class="mb-2" :show="items.length === 0" variant="success">
        <b-icon class="mr-1" icon="emoji-sunglasses"></b-icon>
        No items to read, come back later.
      </b-alert>
      <b-list-group v-if="items.length > 0">
        <b-list-group-item
          class="d-md-flex justify-content-between align-items-center"
          v-for="item in items"
          v-bind:key="item.id"
          target="_blank"
          :variant="itemColor(item)"
          rel="nofollow noopener">
          <span class="d-block mb-3 mb-md-0 item-text-wrapper">
            <strong class="d-block mb-2">{{ item.feed_title }}</strong>
            <span class="d-flex align-items-top">
              <b-icon class="star-item mr-2 pointer" @click="updateStarred(item.id, '0')" icon="star-fill" v-if="item.is_starred === '1'"></b-icon>
              <b-icon class="star-item mr-2 pointer" @click="updateStarred(item.id, '1')" icon="star" v-if="item.is_starred === '0'"></b-icon>
              <a class="feed-item" :href="item.url" target="_blank" @click="goToItem($event, item.id)">{{ item.title }}</a>
            </span>
          </span>
          <span>
            <b-button class="btn-block btn-read" :variant="item.is_read === '1' ? 'danger' : 'success'" @click="toggleRead(item.id, item.is_read)">
              <span v-show="item.is_read === '1'">Unread</span>
              <span v-show="item.is_read === '0'">Read</span>
            </b-button>
          </span>
        </b-list-group-item>
      </b-list-group>
    </b-overlay>
  </div>
</template>

<script>
import { endpoints } from '@/values';

export default {
  name: 'Home',
  props: ['starred', 'title', 'all'],
  data: function() {
    return {
      items: [],
      showLoading: true
    }
  },
  methods: {
    goToItem: function (event, id) {
      const params = `?id=${id}`

      fetch(`${window.rss_reader.apiUrl}${endpoints.updateRead}${params}`)
        .then(() => {
          this.fetchResources();
        });
    },
    itemColor: function(item) {
      if (item.is_starred === '1') return 'warning'
      if (item.is_read === '1') return 'secondary'

      return ''
    },
    fetchResources: function() {
      let params = `?`

      if (this.starred) {
        params += `starred=1`
      } else if (this.all) {
        params += `all=1`
      }

      this.showLoading = true;

      fetch(`${window.rss_reader.apiUrl}${endpoints.items}${params}`)
        .then(response => response.json())
        .then(items => {
          this.items = items;
          this.showLoading = false;
        });
    },
    updateStarred: function(id, value) {
      const params = `?id=${id}&is_starred=${value}`

      fetch(`${window.rss_reader.apiUrl}${endpoints.updateStarred}${params}`)
        .then(() => {
          this.fetchResources();
        });
    },
    toggleRead: function(id, is_read) {
      const params = `?id=${id}`
      let endpoint = endpoints.updateRead

      if (is_read === '1') endpoint = endpoints.updateUnread

      fetch(`${window.rss_reader.apiUrl}${endpoint}${params}`)
        .then(() => {
          this.fetchResources();
        });
    },
    markAllAsRead: function() {
      let params = `?`

      if (this.starred) {
        params += `starred=1`
      }

      fetch(`${window.rss_reader.apiUrl}${endpoints.updateAllRead}${params}`)
        .then(() => {
          this.fetchResources();
        });
    },
  },
  created: function() {
    this.fetchResources();
  },
  watch: {
    $route() {
      this.fetchResources();
    }
  }
}
</script>

<style lang="scss">
.feed-item { font-size: 1.2rem; }
.star-item { margin-top: 6px; }
@media (min-width: 768px) {
  .item-text-wrapper { max-width: 75%; }
}
.btn-read { min-width: 80px; }
</style>