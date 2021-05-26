import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const router = new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('./views/Home.vue'),
      meta: {
        title: 'Latest items',
      },
      props: {
        starred: false,
        unread: false,
        title: 'Latest items'
      }
    },
    {
      path: '/starred',
      name: 'starred',
      component: () => import('./views/Home.vue'),
      meta: {
        title: 'Starred items',
      },
      props: {
        starred: true,
        unread: false,
        title: 'Starred items'
      }
    },
    {
      path: '/all',
      name: 'all',
      component: () => import('./views/Home.vue'),
      meta: {
        title: 'All items',
      },
      props: {
        starred: false,
        all: true,
        title: 'All items'
      }
    },
    {
      path: '/feeds',
      name: 'feeds',
      component: () => import('./views/Feeds.vue'),
      meta: {
        title: 'Feeds',
      },
    }
  ],
});

router.afterEach((to) => {
  const metaTitle = `${to.meta.title} | RSS Reader`;

  document.title = metaTitle;
});

export default router;
