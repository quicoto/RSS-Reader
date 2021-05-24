<template>
  <div>
    <h1>Home</h1>
    <b-list-group>
      <b-list-group-item v-for="item in items" v-bind:key="item.id">
        <b-icon @click="updateStarred(item.id, '0')" icon="star-fill" v-if="item.is_starred === '1'"></b-icon>
        <b-icon @click="updateStarred(item.id, '1')" icon="star" v-if="item.is_starred === '0'"></b-icon>
        ({{ item.id }}) <a :href="item.url" target="_blank" rel="nofollow noopener">{{ item.title }}</a>
      </b-list-group-item>
    </b-list-group>
  </div>
</template>

<script>
import { endpoints } from '@/values';

export default {
  name: 'Home',
  data: function() {
    return {
      items: [],
      showLoading: true
    }
  },
  methods: {
    fetchResources: function() {
      let endpoint = window.rss_reader.apiUrl

      endpoint += `${endpoints.items}`

      this.showLoading = true;

      fetch(endpoint)
        .then(response => response.json())
        .then(items => {
          this.items = items;
        });
    },
    updateStarred: function(id, value) {
      const data = {
        ID: id,
        is_starred: value
      };
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      };

      fetch(`${window.rss_reader.apiUrl}${endpoints.updateStarred}`, options)
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