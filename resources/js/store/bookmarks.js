import axios from 'axios';

export default {
    state: {
        pref: '/api/bookmarks',
        GET: {
            bookmarks: '/',
            bookmark: '/:bookmark_id',
            search: '/search',
            report: '/report'
        },
        POST: {
            makeBookmark: '/'
        },
        DELETE: {

        },
        PATCH: {

        },
        PUT: {

        },
    },
    getters: {

    },
    mutations: {

    },
    actions: {
        makeBookmark(context, url) {
            let formData = {
                'url': 'https://' + url
            };
            return axios.post(context.state.pref + context.state.POST.makeBookmark, formData)
        },

        list(context, data) {
            let params = {
                params: data
            };

            return axios.get(context.state.pref + context.state.GET.bookmarks, params)
        },

        getBookmark(context, bookmarkId) {
            return axios.get(context.state.pref + context.state.GET.bookmark.replace(':bookmark_id', bookmarkId));
        },

        makeSearch(context, query) {
            let params = {
                params: query
            };

            return axios.get(context.state.pref + context.state.GET.search, params);
        },

        makeReport(context) {
            return axios.get(context.state.pref + context.state.GET.report);
        },

        reportsList(context) {
            return axios.get('/api/reports');
        }
    }
}
