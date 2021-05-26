<template>
  <div>
    <h5>Filter</h5>
    <b-list-group class="mb-4">
      <b-list-group-item variant="primary" to="/"><b-icon icon="eye-slash-fill" class="mr-1"></b-icon> Latest</b-list-group-item>
      <b-list-group-item variant="warning" to="starred"><b-icon icon="star-fill" class="mr-1"></b-icon> Starred</b-list-group-item>
      <b-list-group-item variant="info" to="all"><b-icon icon="list-ul" class="mr-1"></b-icon> All items</b-list-group-item>
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
        :disabled="showLoading"
      ></b-form-input>

      <b-alert class="mb-2" :show="addSuccess" variant="success"><b-icon icon="emoji-smile" class="mr-1"></b-icon> Feed has been added</b-alert>
      <b-alert class="mb-2" :show="addFail" variant="danger"><b-icon icon="emoji-wink" class="mr-1"></b-icon> Feed was already added</b-alert>

      <b-button type="submit" block variant="primary" :disabled="showLoading">
        <span v-show="showLoading">
          <b-spinner small></b-spinner>
        </span>
        <span v-show="!showLoading">
          Add feed
        </span>
      </b-button>
    </b-form>

    <router-link to="feeds" class="text-white text-decoration-none">
      <b-icon icon="gear-fill" class="mr-1"></b-icon>
      Manage Feeds
    </router-link>
  </div>
</template>

<script>
import { endpoints } from '@/values';

export default {
  name: 'Sidebar',
  data: function() {
    return {
      newFeedUrl: '',
      addSuccess: false,
      addFail: false,
      showLoading: false
    }
  },
  methods: {
    onSubmit: function (event) {
      event.preventDefault();
      this.showLoading = true;

      const params = `?url=${encodeURIComponent(this.newFeedUrl)}`

      fetch(`${window.rss_reader.apiUrl}${endpoints.addFeed}${params}`)
        .then(response => response.json())
        .then((data) => {
          this.showLoading = false;
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