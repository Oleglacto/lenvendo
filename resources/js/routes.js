import Bookmarks from  './components/Bookmarks.vue'

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Bookmarks,
            name: 'bookmarks'
        },
    ]
}
