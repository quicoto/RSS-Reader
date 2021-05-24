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
        title: 'Home',
      },
    }
  ],
});

router.afterEach((to) => {
  const metaTitle = `${to.meta.title} | RSS Reader`;

  document.title = metaTitle;
});

export default router;
