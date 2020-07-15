import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios";
import Bookmarks from './bookmarks';

Vue.use(Vuex);

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let store = new Vuex.Store({

    modules: {
        Bookmarks
    },
    state: {

    },
    getters: {

    },
    actions: {

    },

    mutations: {

    }
});

export default store;
