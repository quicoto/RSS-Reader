<template>
  <div>
    <b-overlay
      :show="showLoading"
      spinner-variant="dark"
      spinner-type="grow"
      rounded="sm"
    >
      <h1 class="h2 mb-3">{{ this.title }}</h1>
      <b-list-group>
        <b-list-group-item
          v-for="item in items"
          v-bind:key="item.id"
          target="_blank"
          :variant="itemColor(item)"
          rel="nofollow noopener">
          <strong class="d-block mb-2">{{ item.feed_title }}</strong>
          <b-icon class="mr-2 pointer" @click="updateStarred(item.id, '0')" icon="star-fill" v-if="item.is_starred === '1'"></b-icon>
          <b-icon class="mr-2 pointer" @click="updateStarred(item.id, '1')" icon="star" v-if="item.is_starred === '0'"></b-icon>
          <a class="feed-item" :href="item.url" target="_blank" @click="goToItem($event, item.id)">{{ item.title }}</a>
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
</style>