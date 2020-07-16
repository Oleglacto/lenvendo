import Bookmarks from  './components/Bookmarks.vue'
import Bookmark from  './components/Bookmark.vue'
import Reports from  './components/Reports.vue'

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Bookmarks,
            name: 'bookmarks'
        },
        {
            path: '/bookmarks/:bookmark_id',
            component: Bookmark,
            name: 'bookmark'
        },
        {
            path: '/reports',
            component: Reports,
            name: 'reports'
        },
    ]
}
