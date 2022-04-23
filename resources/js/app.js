require('./bootstrap')

import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import Toastr from 'vue-toastr'

Vue.use(Toastr);

Vue.mixin({methods:{ route : window.route }});


createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    Vue.use(plugin)

    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})

InertiaProgress.init()
